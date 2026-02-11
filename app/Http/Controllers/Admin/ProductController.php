<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
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
    public function store(ProductStoreRequest $request, string $type): JsonResponse
    {
        if (!in_array($type, ['physical', 'digital'])) abort(404);

        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->product_type = $type;
        $product->short_description = $request->short_description;
        $product->description = $request->content;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->special_price = $request->special_price;
        $product->special_price_start = $request->from_date;
        $product->special_price_end = $request->to_date;
        $product->qty = $request->quantity;
        $product->manage_stock = $request->has('manage_stock') ? 'yes' : 'no';
        $product->in_stock = $request->stock_status == 'in_stock' ? 1 : 0;
        $product->approved_status = 'approved';
        $product->store_id = $request->store;
        $product->brand_id = $request->brand;
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->is_hot = $request->has('is_hot') ? 1 : 0;
        $product->is_new = $request->has('is_new') ? 1 : 0;
        $product->save();

        
    }
}
