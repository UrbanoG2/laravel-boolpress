<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Model\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "#follow4follow",
            "#like4like",
            "#lifestyle",
            "#travelblogger",
            "#trmaunto",
            "#landscapes",
            "#sunset",
            "#foodporn",
            "#staystrong",
            "#young&foolish",
            "#inToTheWild"
        ];

        foreach ($tags as $tag) {
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, "-");
            $newTag->save();
        }
    }
}
