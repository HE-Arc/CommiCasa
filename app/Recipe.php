<?php

namespace CommiCasa;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'name_recipe_id',
        'quantity_required'
    ];
}
