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
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title></title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/css/owl.theme.default.min.css">
    <!-- Custom styles for this template -->
    <link href="/css/style.css" rel="stylesheet">
    @yield('head-css')
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/js/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="/js/forms.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/backend.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="logo"><a href="/"><img width="100%" src="/images/logo-beta.png"></a></div>
                </div>
                <div class="col-10 col-md-7">
                    {{ Menu::get() }}
                </div>
                <div class="col-2 col-md-2">
                    @if (Auth::check())
                        <div class="dropdown custom-dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bars" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                <a class="dropdown-item" href="/user/{{ Auth::user()->login }}/books">Мои книги</a>
                                <a class="dropdown-item" href="/user/messages">Мои сообщения</a>
                                <a class="dropdown-item" style="cursor: not-allowed">Мои отзывы</a>
                                <a class="dropdown-item" style="cursor: not-allowed">Мои рейтинг</a>
                                <a class="dropdown-item" href="/user/wishes">Мои пожелания</a>
                                <a class="dropdown-item" href="/user/favorite">Избранное</a>
                                <a class="dropdown-item" href="/user/settings">Настройки</a>
                                <a class="dropdown-item" href="/user/logout">Выход</a>
                            </div>
                        </div>
                    @else
                        <div class="header-sign">
                            <a href="/user/sign-in">Вход</a>
                            <a class="sign-up-button" href="/user/sign-up">Регистрация</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="sub-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-2">
                        <div class="chosen-city-block">
                            <div class="title">Город:</div>
                            <div class="name" onclick="$('#city-choose-modal').modal(); return false;">
                                {{ \App\Components\Session::getCity()->title }}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-10">
                        <form class="fast-search" action="/search" method="GET">
                            <input placeholder="Введите название книги, автора или издательство" class="text" name="q" type="text" value="{{ request('q') ?? request('q') }}">
                            <button class="button" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="links">
                            <a href="/feedback">Обратная связь</a>
                            <a href="/wishes">Ваши пожелания</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    <footer>
        <hr>
        asdas
    </footer>
    @include('modals.city-choose')
    @include('modals.send-message')
    @include('modals.system-message')
    @include('main.toast.index')
</body>
</html>
