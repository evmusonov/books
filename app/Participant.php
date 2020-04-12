<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    public $guarded = [];

    public function data()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
