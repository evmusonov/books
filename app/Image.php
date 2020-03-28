<?php

namespace App;

use Illuminate\Support\Facades\Storage;

class Image
{
    public static function render($thumb, $version = '')
    {
        $version = !empty($version) ? $version . '/' : '';
        return '<img src="' . asset("storage/{$thumb->module}/{$thumb->content_id}/{$version}{$thumb->filename}") . '">';
    }
}
