<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $table = 'sizes';
    protected $fillable = ['id', 'sizes', 'pro_id'];
    public $timestamps = false;

    public function products(){
    	return $this->belongsToMany('App\Product');
    }
}
