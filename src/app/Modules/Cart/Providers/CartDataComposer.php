<?php

namespace App\Modules\Cart\Providers;
use App\Modules\Cart\Repository\CartRepository;

class CartDataComposer
{
    protected $cartRepository;

    public function __construct(CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }
    public function compose($view)
    {
        $view->with('cart_count', $this->cartRepository->count());
        $view->with('total', $this->cartRepository->total());
    }
}