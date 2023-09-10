<?php

namespace App\Modules\Cart\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Cart\Repository\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function index(){
        $cart = $this->cartRepository->get();
        return view('cart::index',
            [
                'cart_items' => $cart,
                'total' => $this->cartRepository->total(),
            ]
        );
    }

    public function addToCart(Request $request){
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $this->cartRepository->add($request->product_id);
        
        return response()->json([
            'message' => 'Cart updated successfully',
            'total' => $this->cartRepository->total(),
            'count' => $this->cartRepository->count(),
        ]);
    }
}
