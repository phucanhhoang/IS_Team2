<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $table = 'social_account';

    public $timestamps = true;

    protected $fillable = ['user_id', 'provider_user_id', 'provider'];

}