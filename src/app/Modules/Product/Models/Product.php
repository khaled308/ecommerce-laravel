<?php

namespace App\Modules\Product\Models;

use App\Modules\Category\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "slug",
        "short_description",
        "description",
        "price",
        "discount",
        "featured",
        "status",
        "quantity",
        "sku",
        "image",
        "category_id",
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
