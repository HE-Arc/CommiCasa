<?php

namespace CommiCasa;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'description'
    ];
}
