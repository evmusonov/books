<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'city_id', 'login', 'email', 'password', 'email_verify_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function getPasswordHash($email)
    {
        $user = self::where(['email' => $email])->first();
        if ($user) {
            return $user->password;
        }
    }

    public function getBooks()
    {
        return Book::where('user_id', $this->id)->orderBy('created_at', 'desc')->get();
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function favBooksIds()
    {
        $favs = Favorite::where('user_id', $this->id)->get();
        $ids = [];

        if ($favs) {
            foreach ($favs as $fav) {
                $ids[] = $fav->book_id;
            }
        }

        return $ids;
    }

    public function messageChannels()
    {
        $relations = Participant::where('user_id', $this->id)->select('channel_id')->get();
        $ids = [];

        if (count($relations)) {
            foreach ($relations as $relation) {
                $ids[] = $relation->channel_id;
            }

            return Channel::whereIn('id', $ids)->get();
        }

        return [];
    }
}
