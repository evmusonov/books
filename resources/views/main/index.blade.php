@extends('main.layout')

@section('content')
    {{ \App\Components\Book\BookBlock::news() }}
@endsection
