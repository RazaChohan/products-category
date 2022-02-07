<?php

namespace Database\Factories;

use Dal\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCategory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * @inheritdoc
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(2, 5, 1000),
        ];
    }
}
