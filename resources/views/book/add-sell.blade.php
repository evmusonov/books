@extends('main.layout')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="form">
                <h1>Добавление книги на продажу <a href="/user/{{ Auth::user()->login }}/books" class="float-right h6 mt-3">Назад</a></h1>
                @if (session('exist'))
                    <p class="alert alert-danger" role="alert">{{ session('exist') }}</p>
                @endif
                <form method="POST" action="/user/{{ Auth::user()->login }}/books" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="deal_type_id" value="{{ \App\BookDealType::getIdByAlias(request('type')) }}">
                    <input type="hidden" name="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                    <div class="form-group">
                        <label>Название</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                        @error('title')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('title') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Автор</label>
                        <input type="text" name="author" class="form-control" value="{{ old('author') }}">
                        @error('author')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('author') }}</p>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="col">
                            <div class="form-group">
                                <label>Издание</label>
                                <input type="text" name="edition" class="form-control" value="{{ old('edition') }}">
                                @error('edition')
                                    <p class="alert alert-danger" role="alert">{{ $errors->first('edition') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Год издания</label>
                                <input type="text" name="year_edition" class="form-control" value="{{ old('year_edition') }}">
                                @error('year_edition')
                                    <p class="alert alert-danger" role="alert">{{ $errors->first('year_edition') }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Количество страниц</label>
                        <input type="text" name="page_count" class="form-control" value="{{ old('page_count') }}">
                        @error('page_count')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('page_count') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Цена</label>
                        <input type="text" name="price" class="form-control" value="{{ old('price') }}">
                        @error('price')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('price') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Тип обложки</label>
                        <select class="custom-select" name="cover_type_id">
                            <option value="">Выбрать</option>
                            @if ($coverTypes)
                                @foreach ($coverTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->title }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('cover_type_id')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('cover_type_id') }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Дополнительное описание</label>
                        <textarea class="form-control" rows="6" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Фото</label>
                        <input type="file" name="image" class="form-control-file" id="exampleFormControlFile1">
                        @error('image')
                            <p class="alert alert-danger" role="alert">{{ $errors->first('image') }}</p>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <input type="hidden" name="status" value="0">
                        <input type="checkbox" class="form-check-input" name="status" id="status" value="1">
                        <label class="form-check-label" for="status">Включено</label>
                        @error('status')
                        <p class="alert alert-danger" role="alert">{{ $errors->first('status') }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary custom-button mt-3">Добавить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
