<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag' => $this->faker->unique()->word(),
           // 'tag' => $this->faker->words($nb = 5, $asText = false),
           // 'photo_id'=>$this->faker->numberBetween($min = 1, $max = 50)
        ];
    }
}
