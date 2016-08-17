<?php
/**
 * Created by IntelliJ IDEA.
 * User: Phuc Anh Hoang
 * Date: 7/5/2016
 * Time: 5:12 PM
 */

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Customer extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    protected $table = 'customers';

    public $timestamps = true;

    protected $fillable = array('id', 'email', 'name', 'address', 'district_id', 'province_id', 'phone', 'activated');

    protected $hidden = ['password', 'confirmation_code', 'remember_token'];

}