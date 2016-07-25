<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['id', 'cat_title'];

    //products
    public function products(){
    	return $this->hasMany('App\Product');
    }
}
