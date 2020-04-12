function sendMessage(from, to, recieverName) {
    $('#send-message-modal').modal();
    $('#send-message-modal').find('.modal-title').html('Отправить сообщение пользователю<br>' + recieverName);
    $('.send-message-to').val(to);
    $('.send-message-from').val(from);
    return false;
}

$(document).ready(function () {

    $('.container').on('mouseover', '.book-item', function() {
        $(this).children('.edit-panel').show();
    }).on('mouseout', '.book-item', function(){
        $(this).children('.edit-panel').hide();
    });

    $('.choose-city-js').on('click', function () {
        let id = $(this).attr('data-id');
        $.post('/main/change-city', {
            '_token': $('meta[name=csrf-token]').attr('content'),
            id: id
        })
            .done(function (response) {
                document.location.href = '/';
            });
    });

    $('.container').on('click', '.change-fav-js', function () {
        let fav = $(this);
        let link = fav.attr('href');
        let id = fav.attr('id');
        let data = id.split('-');
        $.post(link, {
            '_token': $('meta[name=csrf-token]').attr('content'),
            user_id: data[1],
            book_id: data[2]
        })
            .done(function (response) {
                if (response == 'remove') {
                    fav.parent('div').parent('div').removeClass('no-edit-panel').addClass('edit-panel').css('display', 'none');
                    $('.toast-body').text('Книга удалена из избранного');
                    $('#myToast').toast('show');
                } else {
                    fav.parent('div').parent('div').removeClass('edit-panel').addClass('no-edit-panel').css('display', 'block');
                    $('.toast-body').text('Книга добавлена в избранное');
                    $('#myToast').toast('show');
                }
            });

        return false;
    });

    $('.send-message-form').submit(function () {
        let data = $(this).serializeArray();
        data.push({name: '_token', value: $('meta[name=csrf-token]').attr('content')});

        $.post('/main/send-message', data)
            .done(function (response) {
                if (response) {
                    $('.send-message-form').remove();
                    $('#send-message-modal').find('.modal-body').append('<p class="alert alert-success text-center">').text('Сообщение успешно отправлено. Перейдите в раздел «Мои сообщения»');
                } else {
                    $('.send-message-form').remove();
                    $('#send-message-modal').find('.modal-body').append('<p class="alert alert-warning text-center">').text('Произошла ошибка. Пожалуйста, обновите страницу и попробуйте отправить сообщение еще раз');
                }
            });

        return false;
    });

});
