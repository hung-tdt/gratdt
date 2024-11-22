<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'product_category_id' => $this->faker->numberBetween(1, 5), 
            'price' => 20000000, 
            'price_sale' => 17990000, 
            'active' => 1, 
            'thumb' => '/storage/uploads/2024/10/11/29.jpg',
            'images' => json_encode(['/storage/uploads/2024/10/11/29.jpg']),
            'quantity' => 0,
            'sold_count' => 0, 
        ];
    }
}
