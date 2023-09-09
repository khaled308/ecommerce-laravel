<?php

namespace App\Modules\Cart\Repository;
use App\Modules\Cart\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class CartRepository implements CartRepositoryI {
    public function get(){
        return Cart::where('cookie_id', $this->getCookieId())->get();
    }

    public function add($product_id, $quantity = 1){
        $cart = Cart::where('cookie_id', $this->getCookieId())
                    ->where('product_id', $product_id)
                    ->first();

        if ($cart) {
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            Cart::create([
                'cookie_id' => $this->getCookieId(),
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }
    }
    public function update($product_id, $quantity){
        $cart = Cart::where('cookie_id', $this->getCookieId())
                    ->where('id', $product_id)
                    ->first();
        
        if ($cart) {
            $cart->quantity = $quantity;
            $cart->save();
        }else {
            Cart::create([
                'cookie_id' => $this->getCookieId(),
                'product_id' => $product_id,
                'quantity' => $quantity,
            ]);
        }
    }
    public function delete($product_id){
        $cart = Cart::where('cookie_id', $this->getCookieId())
                    ->where('id', $product_id)
                    ->first();
        
        if ($cart) {
            $cart->delete();
        }

    }
    public function clear(){
        Cart::where('cookie_id', $this->getCookieId())->delete();
    }
    public function count(){
        return Cart::where('cookie_id', $this->getCookieId())->count();
    }
    public function total(){
        return Cart::where('cookie_id', $this->getCookieId())
            ->join('products', 'products.id', '=', 'carts.product_id')
            ->selectRaw('sum(carts.quantity * products.price) as total')
            ->value('total');
    }
    
    private function getCookieId(){
        $cookie_id = Cookie::get('cart_id');

        if (!$cookie_id) {
            $cookie_id = Str::uuid();
            Cookie::queue('cart_id', $cookie_id, 60 * 24 * 30);
        }

        return $cookie_id;
    }
}