<?php

namespace Database\Seeders;

use App\Http\Controllers\CategoryController;
use Illuminate\Database\Seeder;
use App\Models\Photo;
use App\Models\User;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        User::factory(50)->create();
        Photo::factory(20)->create(['created_at'=>'2020-05-30 15:17:25']);
        Photo::factory(10)->create(['created_at'=>'2021-04-01 15:17:25']);
        Photo::factory(10)->create(['created_at'=>'2021-05-01 15:17:25']);
        Photo::factory(20)->create();
        Comment::factory(100)->create();
        Category::factory(30)->create();
        //Rating::factory(100)->create();

    }
}
