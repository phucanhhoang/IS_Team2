<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colors';
	protected $fillable = ['color_id', 'color', 'pro_id'];
	//products
	public function products(){
		return $this->belongsToMany('App\Product');
	}
}
