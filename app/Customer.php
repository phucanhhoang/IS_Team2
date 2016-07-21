<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/5/2016
 * Time: 5:12 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    public $timestamps = true;

    protected $fillable = array('id', 'name', 'address', 'district', 'city', 'phone', 'created_at', 'updated_at');

    public function users()
    {
        return $this->morphMany('App\User', 'userable');
    }

}