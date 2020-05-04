@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <h1>Мои сообщения</h1>
            <hr>
            @if (session('message'))
                <p class="alert alert-success">{{ session('message') }}</p>
            @endif
        </div>
    </div>
    <div class="row messages">
        @if (count($channels))
            @foreach($channels as $channel)
                <div class="col-sm-12 mb-3">
                    <a href="/user/messages/{{ $channel->id }}" class="link">
                        <div class="block {{ count($channel->unreadMessages) > 0 ? 'border' : '' }}">
                            <div class="header">
                                <div class="username">{{ $channel->participant->data->name ?? $channel->participant->data->login }} <span class="new">(Новые сообщения: {{ count($channel->unreadMessages) }})</span></div>
                                <div class="date">Дата последнего сообщения {{ date('d.m.Y H:s', strtotime($channel->lastMessageTime->created_at)) }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <div class="col-sm-12">У вас пока нет личных сообщений</div>
        @endif
    </div>
@endsection
