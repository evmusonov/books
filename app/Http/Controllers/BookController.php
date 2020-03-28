<?php

namespace App\Http\Controllers;

use App\Book;
use App\Menu;
use Evmusonov\LaravelFileHelper\FileHelper;
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

    public function list()
    {
        $books = Book::where([
            ['status', 1],
            ['moderation', 1]
        ])->orderBy('created_at', 'desc')->paginate(20);

        return view('book.list', [
            'books' => $books,
        ]);
    }

    public function view(Book $book)
    {
        return view('book.view', [
            'book' => $book,
        ]);
    }

    public function add()
    {
        $type = \request()->get('type');
        $coverTypes = DB::table('book_cover_types')->get();

        if ($type === 'sell') {
            return view('book.add-sell', ['coverTypes' => $coverTypes]);
        } elseif ($type === 'rent') {
            return view('book.add-rent', ['coverTypes' => $coverTypes]);
        } elseif ($type === 'swap') {
            return view('book.add-swap', ['coverTypes' => $coverTypes]);
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
                'category_id' => 'required|integer',
                'year_edition' => 'required|integer',
                'page_count' => 'required|integer',
                'price' => 'nullable',
                'cover_type_id' => 'required|integer',
                'deal_type_id' => 'integer',
                'description' => 'nullable',
                'rent_amount' => 'nullable',
                'rent_type_id' => 'nullable',
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
            $imageUploader->upload($this->module . '/' . $book->getAttributes()['id'])->resize('thumb')->resize('300x400');

            $userName = Auth::user()->login;
            return redirect("/user/$userName/books")->with('createMessage', 'Книга добавлена');
        } else {
            return back()->withErrors($validator)->withInput();
        }
    }

    public function edit(Book $book)
    {
        $type = \request()->get('type');
        $coverTypes = DB::table('book_cover_types')->get();

        if ($type === 'sell') {
            return view('book.edit-sell', ['coverTypes' => $coverTypes, 'book' => $book]);
        } elseif ($type === 'rent') {
            return view('book.edit-rent', ['coverTypes' => $coverTypes, 'book' => $book]);
        } elseif ($type === 'swap') {
            return view('book.edit-swap', ['coverTypes' => $coverTypes, 'book' => $book]);
        }

        return redirect('/error');
    }

    public function update(Book $book)
    {
        $validator = $this->formValidate();
        if (!$validator->fails()) {
            $book->moderation = 0;
            $book->update($validator->validate());

            $uploadManager = new FileManager();
            $imageUploader = $uploadManager->createImageUploder('image');
            $imageUploader->upload($this->module . '/' . $book->id)->resize('thumb')->resize('300x400');

            $userName = Auth::user()->login;
            return redirect("/user/$userName/books")->with('createMessage', "Книга \"{$book->title}\" изменена и находится на модерации");
        } else {
            return back()->withErrors($validator)->withInput();
        }
    }

    public function changeStatus(Book $book)
    {
        $book->status = !$book->status;
        $book->save();

        return back()->with('createMessage', "Статус книги \"{$book->title}\" изменен");
    }

    public function delete(Book $book)
    {

    }
}
