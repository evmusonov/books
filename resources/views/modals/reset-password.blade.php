@component('modals.modal')
    @slot('name', 'reset-password-modal')
    @slot('title', 'Сброс пароля')

    <div class="modal-text">Введите ваш E-mail адрес, на него будет выслано письмо с новым паролем,
        который Вы сможете поменять в настройках профиля.</div>

    <form id="form-reset-password" action="" method="post">
        @csrf
        <div class="form-group">
            <label for="user-name">E-mail</label>
            <input id="user-name" class="form-control" name="email" type="text">
        </div>

        <button type="submit" class="btn btn-primary custom-button">Сбросить</button>
    </form>
{{--    @slot('buttons')--}}
{{--    @endslot--}}
@endcomponent
