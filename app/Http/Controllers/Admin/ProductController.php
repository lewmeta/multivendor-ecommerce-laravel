<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\Tag;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use FileUploadTrait;

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
    public function store(ProductStoreRequest $request, string $type)
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

        /** Attach categories */
        $product->categories()->sync($request->categories);

        /** Attach tags */
        $product->tags()->sync($request->tags);

        if ($type === 'physical') {
            return response()->json([
                'id' => $product->id,
                'redirect_url' => route('admin.products.edit', $product->id) . '#product-images',
                'status' => 'success',
                'message' => 'Product created successfully'
            ]);
        } else {
            return response()->json([
                'id' => $product->id,
                'redirect_url' => route('admin.digital-products.edit', $product->id) . '#product-images',
                'status' => 'success',
                'message' => 'Product created successfully'
            ]);
        }
    }

    /**
     * Show product editing form
     * 
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        $product = Product::findOrFail($id);

        // Product cateogries (ids)
        $productCategoryIds = $product->categories->pluck('id')->toArray(); // Transform Collection to array of IDs
        $productTagIds = $product->tags->pluck('id')->toArray();
        $stores = Store::select(['name', 'id'])->get();
        $brands = Brand::select(['name', 'id'])->where('is_active', 1)->get();
        $tags = Tag::where('is_active', 1)->get();
        $categories = Category::getNested();

        $attributesWithValues = $product?->attributesWithValues ?? [];
        // dd($attributesWithValues);


        return view('admin.product.edit', compact('product', 'stores', 'brands', 'tags', 'categories', 'productCategoryIds', 'productTagIds', 'attributesWithValues'));
    }

    function update(ProductUpdateRequest $request, int $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
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
        $product->status = $request->status;
        $product->approved_status = $request->approved_status;
        $product->store_id = $request->store;
        $product->brand_id = $request->brand;
        $product->is_featured = $request->has('is_featured') ? 1 : 0;
        $product->is_hot = $request->has('is_hot') ? 1 : 0;
        $product->is_new = $request->has('is_new') ? 1 : 0;
        $product->save();

        /** Attach categories */
        $product->categories()->sync($request->categories);

        /** Attach tags */
        $product->tags()->sync($request->tags);

        AlertService::created();

        return response()->json([
            'id' => $product->id,
            'status' => 'success',
            'message' => 'Product updated successfully',
            'redirect_url' => route('admin.products.index')
        ]);
    }

    function uploadImages(Request $request, Product $product)
    {

        $request->validate([
            'file' => ['required', 'image', 'max:3048']
        ]);

        $filePath = $this->uploadFile($request->file('file'));

        $productImage = new ProductImage();
        $productImage->product_id = $product->id;
        $productImage->path = $filePath;
        $productImage->order = ProductImage::where('product_id', 1)->max('order') + $product->id;
        $productImage->save();

        return response()->json([
            'status' => 'success',
            'id' => $productImage->id,
            'path' => asset($filePath),
            'message' => 'Image uploaded successfully'
        ]);
    }

    public function destroyImage(int $id)
    {
        $image = ProductImage::findOrFail($id);
        $this->deleteFile($image->path);
        $image->delete();
        return response()->json(['status' => 'success', 'message' => 'Image deleted successfully']);
    }

    public function imagesReorder(Request $request)
    {
        foreach ($request->images as $image) {
            ProductImage::where('id', $image['id'])->update(['order' => $image['order']]);
        }
    }

    public function storeAttributes(Request $request, Product $product)
    {
        $request->validate([
            'attribute_name' => ['required', 'string', 'max:255'],
            'attribute_type' => ['required', 'string', 'in:text,color'],
        ]);

        DB::beginTransaction();

        try {
            if ($request->filled('attribute_id')) {
                // Update existing attribute
                $this->updateExistingAttribute($request, $product);
            } else {
                // Create a new attribute
                $this->createNewAttribute($request, $product);
            }

            DB::commit();

            // Regenerate product variants
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 500);
        }

        return $this->buildSuccessResponse($product);
    }

    public function createNewAttribute(Request $request, Product $product)
    {
        $attribute = new Attribute();
        $attribute->name = $request->attribute_name;
        $attribute->type = $request->attribute_type;
        $attribute->save();

        $this->addAttributeValue($attribute, $request, $product);
    }

    public function updateExistingAttribute(Request $request, Product $product)
    {
        $attribute = Attribute::findOrFail($request->attribute_id);
        $attribute->name = $request->attribute_name;
        $attribute->type = $request->attribute_type;
        $attribute->save();

        // Remove existing attribute relations and values
        $this->clearAttributeData($attribute, $product);
        $this->addAttributeValue($attribute, $request, $product);
    }

    public function clearAttributeData(Attribute $attribute, Product $product)
    {
        // Detach attribute values from product
        DB::table('product_attribute_values')
            ->where('product_id', $product->id)
            ->where('attribute_id', $attribute->id)
            ->delete();

        // Delete attribute values
        AttributeValue::where('attribute_id', $attribute->id)
            ->delete();
    }

    public function addAttributeValue(Attribute $attribute, Request $request, Product $product)
    {
        $labels = $request->label ?? [];

        foreach ($labels as $index => $label) {
            if (empty($label)) continue;

            $attributeValue = new AttributeValue();
            $attributeValue->attribute_id = $attribute->id;
            $attributeValue->value = $label;
            $attributeValue->color = $request->color_value[$index] ?? null;
            $attributeValue->save();

            // Link to product;
            DB::table('product_attribute_values')->insert([
                'product_id' => $product->id,
                'attribute_id' => $attribute->id,
                'attribute_value_id' => $attributeValue->id,
            ]);
        }
    }

    public function buildSuccessResponse(Product $product)
    {
        $product->refresh();
        $attributes = $product->attributesWithValues;

        $html = '';
        // $variantHtml = '';

        // Build HTML for attributes and variants
        foreach ($attributes as $attribute) {
            $html .= view('admin.product.partials.attribute', compact('attribute', 'product'))->render();
        }

        return response()->json([
            'message' => 'Attribute generated',
            'html' => $html,
        ]);
    }
}
