@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Мои книги</h1>
            <hr>
            @if (session('createMessage'))
                <p class="alert alert-success">{{ session('createMessage') }}</p>
            @endif
            <div class="dropdown custom-dropdown-left">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Добавить книгу
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @if ($dealTypes)
                        @foreach ($dealTypes as $type)
                            <a class="dropdown-item" href="/books/add?type={{ $type->alias }}">{{ $type->title }}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row user-books-list pt-3">
        @if ($user->getBooks())
            @foreach($user->getBooks() as $book)
                <div class="col-sm-3 mb-4">
                    @include('book.card', ['book' => $book])
                </div>
            @endforeach
        @endif
    </div>
@endsection
