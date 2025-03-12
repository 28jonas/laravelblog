<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    //
    protected $fillable=[
        'name'
    ];

    use SoftDeletes;


    public function posts(){
        return $this->morphedByMany(Post::class, 'categoryable');
    }
}
