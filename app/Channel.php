<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Channel extends Model
{
    public $guarded = [];

    public function participant()
    {
        return $this->hasOne('App\Participant', 'channel_id', 'id')->where('user_id', '!=', Auth::user()->id);
    }

    public function messages()
    {
        return $this->hasMany('App\Message', 'channel_id', 'id')->orderBy('created_at');
    }

    public function lastMessageTime()
    {
        return $this->hasOne('App\Message', 'channel_id', 'id')->select('created_at')->orderBy('created_at', 'desc');
    }

    public function unreadMessages()
    {
        return $this->hasMany('App\Message', 'channel_id', 'id')->where([
            ['last_read', 0],
            ['channel_id', $this->id],
            ['user_id', '!=', Auth::user()->id]
        ]);
    }

    public static function find($firstUserId, $secondUserId)
    {
        $firstUserChannels = Participant::where('user_id', $firstUserId)->select('channel_id')->get();
        $secondUserChannels = Participant::where('user_id', $secondUserId)->select('channel_id')->get();

        if (count($firstUserChannels) && count($secondUserChannels)) {
            foreach ($firstUserChannels as $fChannel) {
                foreach ($secondUserChannels as $sChannel) {
                    if ($fChannel->channel_id == $sChannel->channel_id) {
                        return $fChannel->channel_id;
                    }
                }
            }
        }

        return null;
    }
}
