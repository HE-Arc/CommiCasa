<?php

namespace CommiCasa;

use Illuminate\Database\Eloquent\Model;

class ListRecipe extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image'
    ];
}
