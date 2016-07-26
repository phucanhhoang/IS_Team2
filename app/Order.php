<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = 'orders';
	protected $fillable = ['id', 'customer_id', 'total_money', 'status'];

	//customer
	public function customer(){
		return $this->belongsTo('App\Customer');
	}
}
