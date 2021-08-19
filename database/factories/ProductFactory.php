<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [
            'description' => $this->faker->text(20),
            'amount' => $this->faker->randomDigit(),
            'images' => $this->faker->text(10)."png",
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1
        ];
    }
}
