<?php

namespace CommiCasa;

use Illuminate\Database\Eloquent\Model;

class ListRecipe extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image'
    ];
}
