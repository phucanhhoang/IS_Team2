<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['id', 'sizes', 'pro_id'];

    public function products(){
    	return $this->belongsToMany('App\Product');
    }
}
