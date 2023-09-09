<?php

namespace App\Modules\Cart\Repository;

interface CartRepositoryI {
    public function get();
    public function add($product_id, $quantity);
    public function update($product_id, $quantity);
    public function delete($product_id);
    public function clear();
    public function count();
    public function total();
}