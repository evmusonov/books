<?php

namespace App\Http\Controllers;

use App\Book;
use App\Menu;
use Evmusonov\LaravelFileHelper\FileManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    private $module = 'book';

    public function messages()
    {
        return [
            'email.required' => 'E-mail обязателен для заполнения',
            'email.exists' => 'E-mail не найден',
            'password.required'  => 'Пароль обязателен для заполнения',
        ];
    }

    public function userList(Request $request)
    {
        $dealTypes = DB::table('book_deal_types')->get();
        $user = $request->user();

        return view('book.user-list', [
            'dealTypes' => $dealTypes,
            'user' => $user
        ]);
    }

    public function create()
    {
        $type = \request()->get('type');
        $coverTypes = DB::table('books_cover_types')->get();

        if ($type === 'sell') {
            return view('book.create-sell', ['coverTypes' => $coverTypes]);
        } elseif ($type === 'rent') {
            return view('book.create-rent', ['coverTypes' => $coverTypes]);
        } elseif ($type === 'swap') {
            return view('book.create-swap', ['coverTypes' => $coverTypes]);
        }

        return redirect('/error');
    }

    public function formValidate()
    {
        return Validator::make(
            request()->all(),
            [
                'title' => 'required',
                'author' => 'required',
                'edition' => 'required',
                'year_edition' => 'required|integer',
                'page_count' => 'required|integer',
                'price' => 'nullable',
                'cover_type_id' => 'required|integer',
                'deal_type_id' => 'integer',
                'description' => 'nullable',
                'status' => 'boolean',
                'user_id' => 'integer',
            ],
            $this->messages()
        );
    }

    public function store()
    {
        $validator = $this->formValidate();
        if (!$validator->fails()) {
            $book = Book::create($validator->validate());

            $uploadManager = new FileManager();
            $imageUploader = $uploadManager->createImageUploder('image');
            $imageUploader->upload($this->module . '/' . $book->getAttributes()['id'])->resize('thumb');

            $userName = Auth::user()->login;
            return redirect("/user/$userName/books")->with('createMessage', 'Книга добавлена');
        } else {
            return back()->withErrors($validator)->withInput();
        }
    }
}
