<?php

namespace CommiCasa;

use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    protected $fillable = [
        'product_id',
        'user_id'
    ];
}
