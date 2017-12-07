<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'Эти учётные данные не соответствуют нашим записям.',
    'throttle' => 'Слишком много попыток входа в систему. Пожалуйста, повторите попытку через: :seconds секунды.',
    'general' => [
        'email' => 'Адрес эл. почты',
        'password' => 'Пароль',
        'confirm-password' => 'Подтвердить пароль',
        'captcha' => 'Captcha',
    ],
    'login' => [
        'form' => [
            'heading' => 'Войти',
            'text' => 'Jaunt through the zoo and collect pieces of a puzzle. If you get a complete picture, you can redeem it for discounts in the zoo shops and the entrance.',
            'remember' => 'Запомнить меня',
            'btn' => [
                'login' => 'Войти',
                'reset' => 'Забыли пароль?',
                'google' => 'Войдите через Google',
                'facebook' => 'Войдите через Facebook',
                'email' => 'Войдите через E-mail',
                'register-account' => 'Зарегистрироваться',
            ],
            'choose-login-method'=> 'Выберите способ входа',
            'or' => 'или',
        ],
    ],
    'register' => [
        'form' => [
            'heading' => 'Зарегистрироваться',
            'name' => 'Имя',
            'btn' => [
                'register' => 'Зарегистрироваться',
            ],
        ],
    ],
    'reset' => [
        'form' => [
            'heading' => 'Сброс пароля',
            'btn' => [
                'send-password-reset-link' => 'Отправить ссылку для сброса пароля',
                'reset-password' => 'Сброс пароля',
            ],
        ],
    ],
    'logout' => [
        'form' => [
            'btn' => [
                'logout' => 'Выход',
            ],
        ],
    ],

];
