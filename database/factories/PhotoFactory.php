<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhotoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Photo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'path' => $this->faker->url(),
            'isPublic' => $this->faker->boolean(),
            'views' => $this->faker->randomDigit(),

            'user_id' => User::pluck('id')->random()
            // 'user_id'=>$this->faker->numberBetween($min = 1, $max = 50)
        ];
    }
}
