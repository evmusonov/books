@component('modals.modal')
    @slot('name', 'send-message-modal')
    @slot('title', 'Отправить сообщение')

    <form class="send-message-form">
        <input type="hidden" name="to" class="send-message-to">
        <input type="hidden" name="from" class="send-message-from">
        <textarea name="text" class="form-control mb-3" rows="6" placeholder="Введите сообщение"></textarea>
        <input class="btn btn-primary custom-button" type="submit">
    </form>

@endcomponent
