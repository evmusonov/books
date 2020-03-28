<?php
namespace App\Components;

use App\City;

class Session
{
    public static function setCity($id = 1)
    {
        session(['city' => $id]);
    }

    public static function getCity()
    {
        if (!session('city', false)) {
            self::setCity();
        }

        return City::find(session('city'))->title;
    }
}
