<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public $guarded = [];

    public function sender()
    {
        return $this->hasOne('App\User', 'id', 'user_id')->select(['login', 'name']);
    }
}
