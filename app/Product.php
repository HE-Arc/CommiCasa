<?php

namespace CommiCasa;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'quantity',
        'user_id',
        'category_id',
        'regular',
        'alert',
        'description',
        'image'
    ];
}
