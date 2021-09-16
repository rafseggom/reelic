<?php

namespace Database\Factories;

use App\Models\Photo;
use App\Models\Rating;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rating::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //'userId' =>$this->faker->numberBetween($min = 1, $max = 25),
            //'photoId' =>$this->faker->numberBetween($min = 1, $max = 25),
            //'comment'=>$this->faker->sentence($nbWords = 40, $variableNbWords = true),
            'rating' => $this->faker->numberBetween($min = 1, $max = 100),


            'user_id' => User::pluck('id')->unique()->random(),
            //'user_id'=>$this->faker->numberBetween($min = 1, $max = 50),

            'photo_id' => Photo::pluck('id')->unique()->random()
            //'photo_id'=>$this->faker->numberBetween($min = 1, $max = 50)
        ];
    }
}
