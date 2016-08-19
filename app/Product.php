<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $table = 'products';
	protected $fillable = ['id', 'pro_name', 'price', 'pro_code', 'discount', 'image', 'full_des', 'cat_id'];

	//category
    public function category(){
    	return $this->belongsTo('App\Category');
    }
    //images
    public function images(){
    	return $this->hasMany('App\Image');
    }
    //sizes
    public function sizes(){
    	return $this->hasMany('App\Size');
    }
    //colors
    public function colors(){
    	return $this->hasMany('App\Color');
    }
}
