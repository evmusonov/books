<?php

namespace App\Components\Book;

use App\Book;

class BookBlock
{
    public static function news($limit = 8)
    {
        $books = Book::where([
            ['status', 1],
            ['moderation', 1]
        ])->orderBy('created_at', 'desc')->limit($limit)->get();

        return view('book.block.news', ['books' => $books]);
    }
}
