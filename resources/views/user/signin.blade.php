@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="auth-form">
                <h1>Авторизация</h1>
                @if (session('status'))
                    <p class="alert alert-danger" role="alert">{{ session('status') }}</p>
                @endif
                @if (session('emailError'))
                    <p class="alert alert-danger" role="alert">{{ session('emailError') }}</p>
                @endif
                <form method="POST" action="/user/sign-in">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">E-mail</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('email') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Пароль</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('password') }}</p>
                        @enderror
                        @if (session('passwordError'))
                            <p class="alert alert-danger" role="alert">{{ session('passwordError') }}</p>
                        @endif
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="remember" value="0">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Запомнить</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Войти</button>
                </form>
            </div>
        </div>
    </div>
@endsection
