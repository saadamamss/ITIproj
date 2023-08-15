<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->unique()->words($nb = 6, $asText = true);
        $slug = Str::slug($name,'-');

        return [
            'name'=>$name,
            'slug'=>$slug,
            'price'=> $this->faker->numberBetween(99,1000),
            'desc'=>$this->faker->text(500),
            'stock'=>'in',
            'quantity'=>$this->faker->numberBetween(10,50),
            'image'=> 'product-'.$this->faker->numberBetween(1,50),
            'cat_id'=>$this->faker->numberBetween(1,15),
        ];
    }
}
