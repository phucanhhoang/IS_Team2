<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProColor extends Model
{
    protected $table = 'procolors';
	protected $fillable = ['id', 'pro_id', 'color_id'];
    public $timestamps = false;

	public function products(){
    	return $this->hasMany('App\Product');
    }

    public function colors(){
    	return $this->hasMany('App\Color');
    }
}
