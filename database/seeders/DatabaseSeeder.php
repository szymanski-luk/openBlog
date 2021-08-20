<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $faker = Faker::create();

        /*foreach (range(1,10) as $index) {
            User::create([
                'name' => $faker->name,
                'password' => $faker->password,
                'email' => $faker->email,
                'description' => $faker->realText(70),
                'blog_title' => $faker->company(),
                'blog_description' => $faker->realText(90)
            ]);
        }*/

        /*foreach (range(1,10) as $index) {
            Post::create([
                'title' => $faker->sentence,
                'content' => $faker->realText(2500),
                'category_id' => $index,
                'user_id' => $index+1
            ]);
        }*/


        foreach (range(1,10) as $index) {
            Comment::create([
                'content' => $faker->realText(250),
                'post_id' => 15,
                'user_id' => $index+3
            ]);
        }

    }
}
