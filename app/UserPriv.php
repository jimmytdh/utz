<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPriv extends Model
{
    protected $connection = 'users';
    protected $table = 'user_priv';
    protected $fillable = ['user_id','level','syscode'];
    public $timestamps = false;
}
