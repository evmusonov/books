@extends('main.layout')

@section('content')
    <div class="row pb-4">
        <div class="col-sm-12">
            <div class="form p-5">
                <h1 class="mb-4">Настройки <a href="/user/{{ Auth::user()->login }}/books" class="float-right h6 mt-3">Назад</a></h1>
                @if (session('exist'))
                    <p class="alert alert-danger" role="alert">{{ session('exist') }}</p>
                @endif
                <form method="POST" action="/user/{{ $user->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Имя</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                        @error('name')
                        <p class="alert alert-danger" role="alert">{{ $errors->first('name') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="text" name="email" class="form-control" value="{{ $user->email }}">
                        @error('email')
                        <p class="alert alert-danger" role="alert">{{ $errors->first('email') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Телефон</label>
                        <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
                        @error('phone')
                        <p class="alert alert-danger" role="alert">{{ $errors->first('phone') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Город</label>
                        <select class="custom-select" name="city_id">
                            <option>Выбрать</option>
                            @foreach(\App\City::where('status', 1)->get() as $city)
                                <option value="{{ $city->id }}" {{ $user->city_id == $city->id ? 'selected' : '' }}>{{ $city->title }}</option>
                            @endforeach
                        </select>
                        @error('city')
                        <p class="alert alert-danger" role="alert">{{ $errors->first('city') }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary custom-button mt-3">Изменить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
