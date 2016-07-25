<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'orderdetails';
	protected $fillable = ['id', 'order_id', 'pro_id','pro_name', 'price','qty'];


	public function order(){
		return $this->belongsTo('App\Order');
	}
}
