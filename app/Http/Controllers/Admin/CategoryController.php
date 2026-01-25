<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index(): View
    {
        return view('admin.category.index');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validation and storage logic goes here
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', 'unique:categories,slug'],
            'parent_id' => ['nullable', 'exists:categories,id'], // Categoies can be nested based on parent_id
            'is_active' => ['boolean'],
            'is_featured' => ['boolean'],
        ]);

        // prevent circular reference and max depth
        if ($data['parent_id'] ?? null) {
            $parent = Category::find($data['parent_id']);
            $depth = 1;

            while ($parent && $parent->parent_id) {
                $depth++;
                $parent = $parent->parent;
                if ($depth >= 3) break;
            }

            if ($depth >= 3) {
                throw ValidationException::withMessages([
                    'parent_id' => 'Maximum depth reached'
                ]);
            }
        }


        $data['position'] = Category::where('parent_id', $data['parent_id'] ?? null)->max('position') + 1; // Set position for ordering.

        // Create the category (basic)
        $category = Category::create($data);

        return response()->json(['success' => true, 'message' => 'Category created successfully', 'category' => $category]);
    }

    /**
     * Update category order
     */
    public function updateOrder(Request $request): JsonResponse
    {
        $tree = $request->tree;
        try {
            DB::transaction(function () use ($tree) {
                $this->updateTree($tree, null);
            });

            return response()->json([
                'success' => true,
                'message' => 'Category order updated',
            ]);
        } catch (\Throwable $th) {
            Log::error('Category Order Update Error: ', $th);
            return response()->json([
                'success' => false,
                'message' => 'Failed to update category order'
            ], 500);
        }
    }

    /**
     * Update tree recursively
     */
    public function updateTree($nodes, $parentId)
    {
        foreach ($nodes as $position => $node){
            $category = Category::find($node['id']);
            $category->update([
                'parent_id' => $parentId,
                'position' => $position,
            ]);

            if (isset($node['children']) && is_array($node['children'])) {
                $this->updateTree($node['children'], $category->id);
            }
        }
    }

    /**
     * Display the specified category.
     */
    public function show($id): JsonResponse
    {
        $category = Category::findOrFail($id);
        return response()->json(['success' => true, 'category' => $category]);
    }

    /**
     * Get nested categories for tree view.
     */
    public function getNestedCategories()
    {
        $categories = Category::getNested();
        return response()->json($categories);
    }
}
