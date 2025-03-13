<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orders = Order::factory(10)->create();
        $products = Product::factory(10)->create();

        $orders->each(function($order) use ($products){
            $order->products()->attach($products->random(rand(1, min(5, $products->count())))->pluck('id')->toArray());
        });
    }
}
