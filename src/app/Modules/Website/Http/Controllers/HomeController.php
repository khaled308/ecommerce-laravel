<?php

namespace App\Modules\Website\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Product\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view("website::index");
    }

    public function shop(){
        $products = Product::paginate(10);

        return view('website::shop', [
            'products' => $products
        ]);
    }
}
