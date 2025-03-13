<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhotoProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $products = Product::factory(10)->create();
        $photos = Photo::factory(30)->create();

        $products->each(function($product) use ($photos){
            $product->photos()->attach(
                $photos->random(rand(1, min(5, $photos->count())))->pluck('id')->toArray()
            );
        });
    }
}
