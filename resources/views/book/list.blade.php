@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Все книги</h1>
            <hr>
            @if (session('createMessage'))
                <p class="alert alert-success">{{ session('createMessage') }}</p>
            @endif
        </div>
    </div>
    <div class="row user-books-list pt-3">
        @if ($books)
            @foreach($books as $book)
                <div class="col-sm-3 mb-4">
                    @include('book.show-card', ['book' => $book])
                </div>
            @endforeach

            <div class="clearfix"></div>
            <div style="margin: 0 auto;">{{ $books->links() }}</div>
        @endif
    </div>
@endsection
