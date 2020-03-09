<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Восстановление пароля на сайте Books-exchange.ru</title>
    <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/theme.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="/css/mail.css" rel="stylesheet">
</head>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="header">
                    <div class="logo">
                        <a href="/"><img width="200" src="/images/logo.png"></a>
                    </div>
                    <div class="slogan">
                        Обмен, аренда и продажа книг
                    </div>
                </div>
                <h1 class="mb-4 mt-4">Регистрация на сайте Book-exchange.ru</h1>
                <div>Здравствуйте, Вы успешно зарегистрировались на сайте! Для того, чтобы начать полноценно пользоваться функциями сайта, подтвердите ваш E-mail адрес, перейдя по ссылке ниже.</div>
                <div><a href="http://{{ $_SERVER['SERVER_NAME'] }}/user/email-confirmation?token={{ $user->email_verify_token }}">{{ $_SERVER['SERVER_NAME'] }}/user/email-confirmation?token={{ $user->email_verify_token }}</a></div>
            </div>
        </div>
    </div>
</main>
</body>
</html>
