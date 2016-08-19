<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProSize extends Model
{
    protected $table = 'prosizes';
	protected $fillable = ['id', 'pro_id', 'size_id'];
    public $timestamps = false;

	public function products(){
    	return $this->hasMany('App\Product');
    }

    public function sizes(){
    	return $this->hasMany('App\Size');
    }
}
