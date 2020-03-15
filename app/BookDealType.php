<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookDealType extends Model
{
    public $guarded = [];

    public static function getIdByAlias($alias)
    {
        $book = self::where('alias', $alias)->first();

        if ($book) {
            return $book->id;
        }

        return null;
    }
}
