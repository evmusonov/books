$(document).ready(function () {
    $('#form-reset-password').on('submit', function () {
        let form = $(this);

        $.post('/user/reset-password', form.serialize())
            .done(function (data) {
                console.log(data);
            });

        return false;
    });

});
