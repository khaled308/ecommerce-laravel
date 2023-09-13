<?php

namespace App\Modules\Product\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Category\Models\Category;
use App\Modules\Product\Http\Requests\CreateProductRequest;
use App\Modules\Product\Http\Requests\EditProductRequest;
use App\Modules\Product\Http\Traits\ProductTrait;
use App\Modules\Product\Models\Product;
use App\Shared\FileUpload\FileUpload;

class ProductController extends Controller
{
    use ProductTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('product::index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product::create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $image_path = FileUpload::upload($request->file('image'), 'products');
        $product = Product::create([
            "name" => $request->name,
            "slug" => str()->slug($request->name),
            "short_description" => $request->short_description,
            "description" => $request->description,
            "price" => $request->price,
            "discount" => $request->discount,
            "quantity" => $request->quantity,
            "image" => $image_path,
            "category_id" => $request->category_id,
        ]);

        $this->uploadProductThumbnails($request->file('images'), $product->id);

        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('product::edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $product->update([
            "name" => $request->name,
            "slug" => str()->slug($request->name),
            "short_description" => $request->short_description,
            "description" => $request->description,
            "price" => $request->price,
            "discount" => $request->discount,
            "quantity" => $request->quantity,
            "category_id" => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            FileUpload::delete($product->image);
            $image_path = FileUpload::upload($request->file('image'), 'products');
            $product->update([
                "image" => $image_path,
            ]);
        }

        if ($request->hasFile('images')) {
            $this->uploadProductThumbnails($request->file('images'), $product->id);
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        FileUpload::delete($product->image);
        $product->images->each(function ($image) {
            FileUpload::delete($image->image);
        });
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
