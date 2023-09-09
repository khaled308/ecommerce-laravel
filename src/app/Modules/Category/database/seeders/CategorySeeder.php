<?php

namespace App\Modules\Category\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            [
                'name' => 'fashion',
                'slug' => str()->slug('fashion'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'electronics',
                'slug' => str()->slug('electronics'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'home decor',
                'slug' => str()->slug('home decor'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => "kid's toys",
                'slug' => str()->slug("kid's toys"),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);   
    }
}
