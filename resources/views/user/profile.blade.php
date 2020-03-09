@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>{{ $user->login }}</h1>
        </div>
    </div>
@endsection
