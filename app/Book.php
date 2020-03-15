<?php

namespace App;

use Evmusonov\LaravelFileHelper\File;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public $guarded = [];

    public function thumb()
    {
        return $this->hasOne('Evmusonov\LaravelFileHelper\File', 'content_id');
    }
}
