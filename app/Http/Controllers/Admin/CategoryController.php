<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Get nested categories for tree view.
     */
    function getNestedCategories()
    {
        $categories = Category::getNested();
        return response()->json($categories);
    }
}
