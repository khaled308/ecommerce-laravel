<?php

namespace App\Modules\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Category\Models\Category;
use App\Modules\Product\Models\Product;
use App\Modules\Slider\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        $latestProducts = Product::latest()->take(8)->get();
        $categories = Category::with('products')->get();

        return view("website::index", [
            'sliders' => $sliders,
            'latestProducts' => $latestProducts,
            'categories' => $categories
        ]);
    }

    public function shop()
    {
        $products = Product::paginate(10);

        return view('website::shop', [
            'products' => $products
        ]);
    }

    public function product(string $slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('website::product-details', [
            'product' => $product
        ]);
    }
}
