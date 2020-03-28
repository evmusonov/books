<?php

namespace App\Http\Controllers;

use App\Components\Session;
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
}
