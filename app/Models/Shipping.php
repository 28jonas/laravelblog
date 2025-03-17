<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    /** @use HasFactory<\Database\Factories\ShippingFactory> */
    use HasFactory;

    protected $fillable = [
        'tracking_number', 'carrier', 'status', 'delivery_date', 'shipping_date', 'shipping_method', 'shipping_cost'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}
