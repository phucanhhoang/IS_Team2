<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['id', 'user_id', 'product_id', 'quantity'];
    protected $hidden = ['remember_token'];

    public $timestamps = true;
}
