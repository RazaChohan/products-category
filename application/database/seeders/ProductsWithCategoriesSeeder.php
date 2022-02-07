<?php

namespace Database\Seeders;

use Dal\Models\Category;
use Dal\Models\Product;
use Illuminate\Database\Seeder;

class ProductsWithCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoriesCollection = Category::factory()->count(20)->create();
        for ($i = 0; $i < 200; $i++) {
            Product::factory()->create([
                'category_id' => $categoriesCollection->random()->id
            ]);
        }

    }

}
