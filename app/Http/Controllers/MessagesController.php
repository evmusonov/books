<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Message;
use App\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $channels = $request->user()->messageChannels();

        return view('user.message.index', ['channels' => $channels]);
    }

    public function show(Channel $channel)
    {
        $unreaded = Message::where([
            ['last_read', 0],
            ['channel_id', $channel->id],
            ['user_id', '!=', Auth::user()->id]
        ])->get();
        if ($unreaded) {
            foreach ($unreaded as $item) {
                $item->last_read = 1;
                $item->save();
            }
        }

        return view('user.message.show', ['channel' => $channel]);
    }
}
