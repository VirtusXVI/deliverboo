<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Dish;

class DishesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i = 0; $i < 10; $i++) {
            $new_dish = new Dish();
            $new_dish->name = ucfirst($faker->words(rand(2, 7), true));
            $new_dish->description = $faker->paragraphs(rand(5, 10), true);
            $new_dish->ingredients = "latte";
            $new_dish->price = $faker->randomFloat(2, 5, 99);
            $new_dish->is_visible = true;
            $new_dish->slug = Str::slug($new_dish->name, '-');
            $new_dish->save();
        }
    }
}
