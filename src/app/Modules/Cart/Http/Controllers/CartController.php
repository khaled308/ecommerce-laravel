<?php

namespace App\Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class CartController extends Controller
{
    public function index(){
        $repository = App::make('cart');
        $cart = $repository->get();
        return view('cart::index',
            [
                'cart_items' => $cart,
                'total' => $repository->total(),
            ]
        );
    }
}
