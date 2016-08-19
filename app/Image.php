<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    
	protected $table = 'images';
	protected $fillable = ['id', 'image', 'pro_id'];

	public $timestamps = false;

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
