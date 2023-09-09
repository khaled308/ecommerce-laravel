<?php

namespace App\Modules\Cart\Models;

use App\Modules\Product\Models\Product;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['cookie_id', 'user_id', 'product_id', 'quantity'];
    public $incrementing = false;

    public static function booted()
    {
        static::creating(function ($cart) {
            $cart->id = (string) Str::uuid();
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault([
            'name' => 'Guest',
        ]);
    }

}
