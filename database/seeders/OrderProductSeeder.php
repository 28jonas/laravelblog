<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $orders = Order::all();

        if ($orders->isEmpty()) {
            $orders = Order::factory(10)->create();
        }

        $orders->each(function ($order) {
            $randomProductsIds = Product::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray();
            $order->products()->attach($randomProductsIds);
        });
    }
}
