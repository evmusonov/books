<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Components\Session;
use App\Message;
use App\Participant;
use Evmusonov\LaravelFileHelper\File;
use Evmusonov\LaravelFileHelper\FileHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }

    public function deleteFile()
    {
        if(request('module') && request('content_id') && request('filename')) {
            $filePath = config('filehelper.pathToStorage') . '/app/public/' . request('module') . '/' . request('content_id');
            if (is_dir($filePath)) {
                FileHelper::deleteDirectory($filePath);
            }
            File::where([
                ['module', request('module')],
                ['content_id', request('content_id')],
                ['filename', request('filename')]
            ])->delete();

            return 1;
        }

        return 0;
    }

    public function changeCity()
    {
        $id = request('id');
        if ($id) {
            Session::setCity($id);
            return 1;
        }

        return 0;
    }

    public function getDate()
    {
        echo date('Y-m-d H:i:s');
    }

    public function sendMessage()
    {
        if (request('to') && request('from') && request('text')) {
            $fromId = request('from');
            $toId = request('to');
            $text = request('text');
            $channelId = Channel::find($fromId, $toId);

            if ($channelId) {
                Message::create([
                    'channel_id' => $channelId,
                    'user_id' => $fromId,
                    'body' => $text,
                    'last_read' => 0,
                    'created_at' => date('Y-m-d H:i:s', time()),
                ]);

                return 1;
            } else {
                $channel = Channel::create([]);
                Participant::create([
                    'channel_id' => $channel->id,
                    'user_id' => $fromId
                ]);
                Participant::create([
                    'channel_id' => $channel->id,
                    'user_id' => $toId
                ]);
                Message::create([
                    'channel_id' => $channel->id,
                    'user_id' => $fromId,
                    'body' => $text,
                    'last_read' => 0,
                    'created_at' => date('Y-m-d H:i:s', time()),
                ]);

                return 1;
            }
        }

        return 0;
    }
}
