@extends('main.layout')

@section('content')
    <div class="book-view-wrapper book-view mt-3 p-4">
        <div class="row">
            <div class="col-sm-12 mb-4">
                <h1 style="color: #333333;">{{ $book->title }}</h1>
                <hr>
            </div>
            <div class="col-sm-5">
                @if ($book->thumb)
                    {!! \App\Image::render($book->thumb, '300x400') !!}
                @endif
            </div>
            <div class="col-sm-7">
                <h3 class="mb-3">Информация о книге</h3>
                <div class="ml-2 fields">
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
                </div>
                <div class="owner mt-4">
                    <div class="row">
                        <div class="col-sm-12">
                            <hr>
                            <div>Книгу разместил <a href="/user/{{ $book->owner->login }}">{{ $book->owner->login }}</a> (г. {{ $book->owner->city->title }})</div>
                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        @if (\Illuminate\Support\Facades\Auth::check())
                            <div class="col-sm-6">
                                @if (\Illuminate\Support\Facades\Auth::user()->id != $book->owner->id)
                                    <div class="div-button" onclick="return sendMessage('{{ \Illuminate\Support\Facades\Auth::user()->id }}', '{{ $book->owner->id }}', '{{ $book->owner->name ?? $book->owner->login }}');">Написать</div>
                                @endif
                            </div>
                            <div class="col-sm-6">
                                @if (\Illuminate\Support\Facades\Auth::user()->id != $book->owner->id)
                                    <div class="div-button">
                                        @if ($book->dealType->id == 1)
                                            Купить книгу
                                        @elseif ($book->dealType->id == 3)
                                            Предложить обмен
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="col-sm-12">Чтобы написать пользователю, авторизуйтесь или зарегистрируйтесь</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
