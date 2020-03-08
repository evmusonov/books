@php
use Illuminate\Support\Facades\Auth;
use App\Components\MenuHelper as Menu;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Продвижение и раскрутка в соц. сетях от 6 000 руб.</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/theme.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.7/typicons.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div><a href="/">Books-exchange.ru</a></div>
                    <div>Обмен, аренда и продажа книг</div>
                </div>
                <div class="col-sm-6">
                    {{ Menu::get() }}
                </div>
                <div class="col-sm-3">
                    @if (Auth::check())
                        <div>Hello, {{ Auth::user()->email }}, <a href="/user/logout">Выход</a></div>
                    @else
                        <div><a href="/user/sign-in">Вход</a> | <a href="/user/sign-up">Регистрация</a></div>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>
</html>
