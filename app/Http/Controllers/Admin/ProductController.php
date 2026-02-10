<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Dispaly a list of products
     * 
     * @return View
     */
    public function index(): View
    {
        $products = Product::orderBy('id', 'desc')->paginate(30);
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product
     * 
     * @return View
     */
    public function create(): View
    {
        $stores = Store::select(['name', 'id'])->get();
        $brands = Brand::select(['name', 'id'])->where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();
        $categories = Category::getNested();
        return view('admin.product.create', compact(
            'stores',
            'brands',
            'tags',
            'categories',
        ));
    }

    /**
     * Create a product
     */
    public function store(): JsonResponse
    {
        dd('This route is working!');
    }

}
