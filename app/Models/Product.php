<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock_quantity' ,
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_product','product_id', 'order_id');
    }

    public function photos(){
        return $this->belongsToMany(Photo::class, 'photo_product', 'product_id', 'photo_id');
    }

}
