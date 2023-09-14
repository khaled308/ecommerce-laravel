<?php

namespace App\Modules\Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'price',
    ];
}
