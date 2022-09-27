<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Restaurant_category;

class RestaurantCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Pizzeria',
            'Sushi',
            'Trattoria',
            'Bar',
            'Pasticceria',
            'Fast-food'
        ];

        foreach($categories as $category_name) {

            $new_category = new Restaurant_category();
            $new_category->name = $category_name;
            $new_category->slug = Str::slug($category_name, '-');
            $new_category->save();

        }
    }
}
