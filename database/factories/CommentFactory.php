<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

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
            'comment' => $this->faker->sentence($nbWords = 50, $variableNbWords = true),

            'user_id' => User::pluck('id')->random(),
            //'user_id'=>$this->faker->numberBetween($min = 1, $max = 50),

            'photo_id' => Photo::pluck('id')->random()
            //'photo_id'=>$this->faker->numberBetween($min = 1, $max = 50)
        ];
    }
}
