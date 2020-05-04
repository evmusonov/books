@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Список книг ({{ \App\Components\Session::getCity()->title }})</h1>
            <hr>
            @if (session('createMessage'))
                <p class="alert alert-success">{{ session('createMessage') }}</p>
            @endif
        </div>
    </div>
    <div class="row pt-3">
        @if (count($books))
            @foreach($books as $book)
                <div class="col-sm-3 mb-4">
                    @include('book.show-card', ['book' => $book])
                </div>
            @endforeach

            <div class="clearfix"></div>
            <div style="margin: 0 auto;">{{ $books->links() }}</div>
        @else
            <div class="col-sm-12">Список пуст</div>
        @endif
    </div>
@endsection
