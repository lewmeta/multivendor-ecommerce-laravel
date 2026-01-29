@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <form action="" class="product-form">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder=""
                                        value="">
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required">Slug</label>
                                    <input type="text" class="form-control" name="slug" id="slug" placeholder=""
                                        value="">
                                    <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required">Short Description</label>
                                    <textarea name="short_description" id="short-editor"></textarea>
                                    <x-input-error :messages="$errors->get('short_description')" class="mt-2" />
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label required">Content</label>
                                    <textarea name="content" id="editor"></textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Overview
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">SKU</label>
                                        <input type="text" class="form-control" name="sku" value="">
                                        <x-input-error :messages="$errors->get('sku')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Price</label>
                                        <input type="text" class="form-control" name="price" value="">
                                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Special Price</label>
                                        <input type="text" class="form-control" name="special_price" value="">
                                        <x-input-error :messages="$errors->get('special_price')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">From Date</label>
                                        <input type="text" class="form-control datepicker" name="from_date"
                                            value="">
                                        <x-input-error :messages="$errors->get('from_date')" class="mt-2" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">To Date</label>
                                        <input type="text" class="form-control datepicker" name="to_date" value=""
                                            id="datepicker-tow">
                                        <x-input-error :messages="$errors->get('to_date')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-check">
                                                <input class="form-check-input manage-stock-check" name="manage_stock"
                                                    type="checkbox">
                                                <span class="form-check-label">Manage Stock</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 manage-stock d-none">
                                        <div class="mb-3">
                                            <label class="form-label">Quantity</label>
                                            <input type="text" class="form-control" name="quantity" value="">
                                            <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>

                                <div class="rwo">
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h3 class="card-title">Stock Status</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="stock_status" checked="" value="in_stock">
                                                        <span class="form-check-label">In Stock</span>
                                                    </label>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="stock_status" checked="" value="out_of_stock">
                                                        <span class="form-check-label">Out Of Stock</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="status" class="form-control" id="">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="draft">Draft</option>
                                        <option value="pending">Pending</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Store</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="store" class="form-control select2" id="">
                                        <option value="published">Select a store</option>
                                        @foreach ($stores as $store)
                                            <option value="{{ $store->id }}">{{ $store->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('store')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Is Featured</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-check form-switch form-switch-3">
                                        <input class="form-check-input" type="checkbox" name="is_featured">
                                        <span class="form-check-label">Enable</span>
                                    </label>
                                    <x-input-error :messages="$errors->get('is_featured')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Categories</h3>
                        </div>
                        <div class="card-body" style="height: 400px; overflow-y: scroll;">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" id="category-search"
                                            placeholder="Search Category">

                                    </div>

                                    <ul class="list-unstyled " id="category-tree">
                                        @foreach ($categories as $category)
                                            <li>
                                                <label for="" class="form-check category-wrapper">
                                                    <input type="checkbox" class="form-check-input category-check"
                                                        name="categories[]" value="{{ $category->id }}">
                                                    <span
                                                        class="form-check-label category-label">{{ $category->name }}</span>
                                                </label>
                                                @if ($category->children_nested && $category->children_nested->count() > 0)
                                                    <ul class="list-unstyled ms-4 mt-2">
                                                        @foreach ($category->children_nested as $child)
                                                            <li>
                                                                <label for="" class="form-check category-wrapper">
                                                                    <input type="checkbox"
                                                                        class="form-check-input category-check"
                                                                        name="categories[]" value="{{ $child->id }}">
                                                                    <span
                                                                        class="form-check-label category-label">{{ $child->name }}</span>
                                                                </label>
                                                                @if ($child->children_nested && $child->children_nested->count() > 0)
                                                                    <ul class="list-unstyled ms-4 mt-2">
                                                                        @foreach ($child->children_nested as $subChild)
                                                                            <li>
                                                                                <label for=""
                                                                                    class="form-check category-wrapper">
                                                                                    <input type="checkbox"
                                                                                        class="form-check-input category-check"
                                                                                        name="categories[]"
                                                                                        value="{{ $subChild->id }}">
                                                                                    <span
                                                                                        class="form-check-label category-label">{{ $subChild->name }}</span>
                                                                                </label>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Brand</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="brand" class="form-control select2" id="">
                                        <option value="">Select a brand</option>
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Label</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_hot">
                                        <span class="form-check-label">Hot</span>
                                    </label>
                                    <label class="form-check">
                                        <input class="form-check-input" type="checkbox" name="is_new">
                                        <span class="form-check-label">New</span>
                                    </label>
                                    <x-input-error :messages="$errors->get('brand')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-header">
                            <h3 class="card-title">Tags</h3>
                        </div>
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <select name="tags[]" class="form-control select2" id=""
                                        multiple="multiple">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="card mb-3">

                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="mb-3 row">
                                    <button class="btn btn-primary mt-3" type="submit">Create</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    </div>
@endsection
