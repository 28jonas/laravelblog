<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Blogpost extends Model
{
    /** @use HasFactory<\Database\Factories\BlogpostFactory> */
    use HasFactory, Notifiable;
    //
    protected $fillable = [
        'title',
        'content',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
