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
        'captcha' => 'Я не робот',
    ],
    'login' => [
        'form' => [
            'heading' => 'Войти',
            'text' => 'Проходя интерактивные тропы зоопарка и верно отвечая на вопросы, вы собираете кусочки головоломки (пазла). Если сложите полную картинку, то сможете получить скидки в магазинах или на кассе зоопарка.',
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
            'labels' => [
                'agree-to-terms-and-policy' => 'Agree to <a href=":terms" target="_blank">terms and conditions</a> and <a href=":policy" target="_blank">privacy policy</a>',
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
