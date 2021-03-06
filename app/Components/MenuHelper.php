<?php
namespace App\Components;

use App\Menu as ModelMenu;

class MenuHelper
{
    public static function get()
    {
        return view('menu.template', ['menu' => ModelMenu::where('status', 1)->orderBy('weight', 'asc')->get()]);
    }
}
