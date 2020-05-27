<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';

    protected $attributes = [
    ];

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
