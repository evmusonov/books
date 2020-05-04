@extends('main.layout')

@section('head-css')
    <link href="/css/messages.css" rel="stylesheet">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="message-page-title">
                <div class="message-page-title-body">
                    <h1><a href="/user/messages" title="Вернуться назад"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> Чат с {{ $channel->participant->data->name ? $channel->participant->data->name : $channel->participant->data->login }}</h1>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div class="row messages">
        <div class="col-sm-12">
            <div id="messages">
                @if ($channel->messages)
                    @foreach ($channel->messages as $message)
                        <div class="{{ $message->sender->login == \Illuminate\Support\Facades\Auth::user()->login ? 'own' : 'mate' }}">
                            <div class="login">
                                {{ $message->sender->name ? $message->sender->name : $message->sender->login }}
                            </div>
                            <div class="text">
                                {{ $message->body }}
                            </div>
                            <div class="date">{{ date('d.m.Y H:i', strtotime($message->created_at)) }}</div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="row messages">
        <div class="col-sm-12">
            <div class="message-form-container">
                <form action="" class="message-form">
                    <textarea id="m" res autocomplete="off" placeholder="Введите сообщение" rows="2"></textarea><button>Отправить</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/js/socket.io.js"></script>
    <script>
        $(function () {
            window.scrollTo(0, document.body.scrollHeight);

            let channel = '{{ $channel->id }}';
            var socket = io('http://books:8080');
            socket.emit('join', '{{ $channel->id }}');
            let username = '{{ \Illuminate\Support\Facades\Auth::user()->name ? \Illuminate\Support\Facades\Auth::user()->name : \Illuminate\Support\Facades\Auth::user()->login }}';
            let userId = '{{ Illuminate\Support\Facades\Auth::user()->id }}';
            let divClass = '';
            $('form').submit(function(e){
                e.preventDefault(); // prevents page reloading
                if ($('#m').val() != "") {
                    socket.emit('chat message', userId, $('#m').val(), username, '{{ date('Y-m-d H:i:s') }}');
                    $('#m').val('');
                }
                return false;
            });
            socket.on('chat message', function(msg, login, time){
                if (username == login) {
                    divClass = 'own';
                } else {
                    divClass = 'mate';
                }
                let date = new Date(time);
                let y = new Intl.DateTimeFormat('ru', { year: 'numeric' }).format(date);
                let M = new Intl.DateTimeFormat('ru', { month: 'numeric' }).format(date);
                let d = new Intl.DateTimeFormat('ru', { day: 'numeric' }).format(date);
                let h = new Intl.DateTimeFormat('ru', { hour: 'numeric' }).format(date);
                let m = new Intl.DateTimeFormat('ru', { minute: 'numeric' }).format(date);
                M = (M < 10) ? '0' + M : M;
                d = (d < 10) ? '0' + d : d;
                m = (m < 10) ? '0' + m : m;
                let correctDate = d + '.' + M + '.' + y + ' ' + h + ':' + m;
                $('#messages').append($('<div class="' + divClass + '">').html('<div class="login">' + login + '</div>' + '<div class="text">' + msg + '</div><div class="date">' + correctDate + '</div>'));
                window.scrollTo(0, document.body.scrollHeight);
            });
        });
    </script>
@endsection
