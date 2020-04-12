@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Избранное</h1>
            <hr>
            @if (session('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
            @endif
        </div>
    </div>
    <div class="row">
        @if (count($favs))
            @foreach ($favs as $fav)
                <div class="col-sm-3 mb-4">
                    @include('book.show-card', ['book' => $fav->book])
                </div>
            @endforeach
        @else
            <div class="col-sm-12">
                Список пуст
            </div>
        @endif
    </div>
@endsection
