<?php

use Illuminate\Database\Seeder;
use App\Order;
use Faker\Generator as Faker;
class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        for($i = 0; $i < 30; $i++) {
            $new_order = new Order();
            $new_order->customer_name = ucfirst($faker->words(rand(2, 3), true));
            $new_order->customer_address = ucfirst($faker->words(rand(2, 3), true));
            $new_order->customer_email = $faker->email();
            $new_order->created_at = $faker->dateTimeThisYear('+6 months');
            $new_order->total_price = $faker->randomFloat(2, 20, 30);
            $new_order->save();
        }
    }
}
