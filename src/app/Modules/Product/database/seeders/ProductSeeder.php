<?php

namespace App\Modules\Product\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->get();
        $data = [
            [
                'name' => 'product-1',
                'slug' => str()->slug('product-1'),
                'short_description' => 'product-1 description',
                'description' => 'product-1 description',
                'price' => 100,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_20.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-2',
                'slug' => str()->slug('product-2'),
                'short_description' => 'product-2 description',
                'description' => 'product-2 description',
                'price' => 200,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_22.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-3',
                'slug' => str()->slug('product-3'),
                'short_description' => 'product-3 description',
                'description' => 'product-3 description',
                'price' => 300,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_10.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-4',
                'slug' => str()->slug('product-4'),
                'short_description' => 'product-4 description',
                'description' => 'product-4 description',
                'price' => 400,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_01.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-5',
                'slug' => str()->slug('product-5'),
                'short_description' => 'product-5 description',
                'description' => 'product-5 description',
                'price' => 500,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_21.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-6',
                'slug' => str()->slug('product-6'),
                'short_description' => 'product-6 description',
                'description' => 'product-6 description',
                'price' => 600,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_15.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-7',
                'slug' => str()->slug('product-7'),
                'short_description' => 'product-7 description',
                'description' => 'product-7 description',
                'price' => 700,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_17.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-8',
                'slug' => str()->slug('product-8'),
                'short_description' => 'product-8 description',
                'description' => 'product-8 description',
                'price' => 800,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_05.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-9',
                'slug' => str()->slug('product-9'),
                'short_description' => 'product-9 description',
                'description' => 'product-9 description',
                'price' => 900,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_07.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-10',
                'slug' => str()->slug('product-10'),
                'short_description' => 'product-10 description',
                'description' => 'product-10 description',
                'price' => 1000,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_02.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-11',
                'slug' => str()->slug('product-11'),
                'short_description' => 'product-11 description',
                'description' => 'product-11 description',
                'price' => 1100,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_09.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'product-12',
                'slug' => str()->slug('product-12'),
                'short_description' => 'product-12 description',
                'description' => 'product-12 description',
                'price' => 1200,
                'category_id' => $categories->random()->id,
                'image' => 'assets/images/products/digital_06.jpg',
                'images' => 'assets/images/products/digital_18.jpg,
                assets/images/products/digital_17.jpg,assets/images/products/digital_15.jpg,
                assets/images/products/digital_02.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('products')->delete();


        foreach ($data as $product) {
            $productId = DB::table('products')->insertGetId([
                'name' => $product['name'],
                'slug' => $product['slug'],
                'short_description' => $product['short_description'],
                'description' => $product['description'],
                'price' => $product['price'],
                'category_id' => $product['category_id'],
                'image' => $product['image'],
                'created_at' => $product['created_at'],
                'updated_at' => $product['updated_at']
            ]);

            $images = explode(',', $product['images']);
            
            foreach ($images as $image) {
                DB::table('product_images')->insert([
                    'product_id' => $productId,
                    'image' => trim($image),
                    'created_at' => $product['created_at'],
                    'updated_at' => $product['updated_at']
                ]);
            }
        }
    }
}
