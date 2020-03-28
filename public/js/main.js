$(document).ready(function () {
    $('.book-item').mouseover(function() {
        $(this).children('.edit-panel').show();
    }).mouseout(function(){
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
});
