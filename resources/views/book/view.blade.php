@extends('main.layout')

@section('content')
    <div class="book-view-wrapper book-view mt-3 p-4">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <h1 style="color: #333333;">{{ $book->title }}</h1>
                <hr>
            </div>
            <div class="col-sm-5">
                {!! \App\Image::render($book->thumb, '300x400') !!}
            </div>
            <div class="col-sm-7">
                <h3 class="mb-3">Информация о книге</h3>
                <div class="ml-2">
                    <div>Категория: {{ $book->category->title }}</div>
                    <div>Автор: {{ $book->author }}</div>
                    <div>Издание и год издания: {{ $book->edition }}, {{ $book->year_edition }} г.</div>
                    <div>Тип обложки: {{ $book->coverType->title }}</div>
                    <div>Количество страниц: {{ $book->page_count }}</div>
                    <div>Тип объявления: {{ $book->dealType->title }}</div>
                    <div>{{ $book->dealPrice() }}</div>
                    @if ($book->description)
                        <div class="extra-info">
                            <div><b>Доп. информация</b></div>
                            <div class="description">{{ $book->description }}</div>
                        </div>
                    @endif
                    <div class="owner mt-4">
                        <div>Книгу разместил</div>
                        <a href="/user/{{ $book->owner->login }}">{{ $book->owner->login }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
