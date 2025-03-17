<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Seeder;

class PhotoProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = Product::all();

        if ($products->isEmpty()) {
            $products = Product::factory(10)->create();
        }

        $products->each(function ($product) {
            $randomPhotoIds = Photo::inRandomOrder()->limit(rand(1, 5))->pluck('id')->toArray();
            $product->photos()->attach($randomPhotoIds);
        });
    }
}
