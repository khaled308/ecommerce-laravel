<?php

namespace App\Modules\Slider\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sliders')->truncate();

        DB::table('sliders')->insert([
            [
                'image' => 'assets/images/main-slider-1-1.jpg',
                'subtitle' => 'Compra todos tus productos Smart por internet',
                'title' => 'Kid Smart Watches',
                'price' => 100,
                'link' => '#'
            ],
            [
                'image' => 'assets/images/main-slider-1-2.jpg',
                'subtitle' => 'On online payments',
                'title' => 'Extra 25% Off',
                'price' => 100,
                'link' => '#'
            ],
            [
                'image' => 'assets/images/main-slider-1-3.jpg',
                'subtitle' => 'Exclusive Furniture Packages to Suit every need.',
                'title' => 'Great Range of Exclusive Furniture Packages',
                'price' => 100,
                'link' => '#'
            ]
        ]);
    }
}
