@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="auth-form">
                <h1 class="mb-4">Регистрация</h1>
                @if (session('status'))
                    <p class="alert alert-danger" role="alert">{{ session('status') }}</p>
                @endif
                <form method="POST" action="/user/sign-up">
                    @csrf
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                        @error('email')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('email') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Пароль</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('password') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Повторите пароль</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @error('password_confirmation')
                        <p class="alert alert-danger" role="alert">{{ $errors->first('password_confirmation') }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary custom-button">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>
@endsection
