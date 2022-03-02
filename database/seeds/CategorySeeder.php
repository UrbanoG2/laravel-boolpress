<?php
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Model\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 15; $i++) { 
            $newCategory = new Category();
            $newCategory->name = $faker->words(2, true);
            $title = "$newCategory->name-$i";
            $newCategory->slug = Str::slug($title, '-');
            $newCategory->save();
        }
    }
}
