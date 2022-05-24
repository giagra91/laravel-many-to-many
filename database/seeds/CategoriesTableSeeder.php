<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $categories = ["travel", "sport", "food", "nature", "holiday", "politics", "gossip", "news", "beach", "summer", "winter"];
        for ($i=0; $i < count($categories) ; $i++) { 
            $newcategory = new Category();
            $newcategory->name = $categories[$i];
            $newcategory->color = $faker->unique()->hexColor();
            $newcategory->save();
        }
    }
}
