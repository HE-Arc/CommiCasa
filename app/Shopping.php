<?php

namespace CommiCasa;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'user_id',
        'quantity_wanted'
    ];
}
