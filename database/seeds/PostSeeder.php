<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Model\Post;
use Illuminate\Support\Str;


class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i <25 ; $i++) { 
            $newPost = new Post();
            $newPost->title = $faker -> sentence(3,true);
            $newPost->author = $faker -> name();
            $newPost->text = $faker -> text();
            $newPost->slug = Str::slug($newPost->title . '-' . $i, '-');
            $newPost->save();
        }
    }
}
