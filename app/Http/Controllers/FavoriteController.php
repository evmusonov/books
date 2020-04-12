<?php

namespace App\Http\Controllers;

use App\Favorite;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favs = Favorite::where('user_id', Auth::user()->id)->get();

        return view('user.favorite.index', ['favs' => $favs]);
    }

    public function change()
    {
        if (request('user_id') && request('book_id')) {
            $fav = Favorite::where([
                ['user_id', request('user_id')],
                ['book_id', request('book_id')]
            ])->first();

            if ($fav) {
                $fav->delete();
                return 'remove';
            } else {
                Favorite::create(['user_id' => request('user_id'), 'book_id' => request('book_id')]);
                return 'add';
            }
        }

        return 0;
    }
}
