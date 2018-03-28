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

    'failed' => 'Sisestatud andmed ei kattu meie süsteemis olevatega.',
    'throttle' => 'Liiga palju sisselogimise katseid. Proovi palun :seconds sekundi pärast uuesti.',
    'general' => [
        'email' => 'E-posti aadress',
        'password' => 'Salasõna',
        'confirm-password' => 'Korda salasõna',
        'captcha' => 'Captcha',
    ],
    'login' => [
        'form' => [
            'heading' => 'Logi sisse',
            'text' => 'Seikle loomaaedades ja kogu kokku puzzletükke. Kui sa oled kokku kogunud terve pildi, saad sa selle vahetada mõne allahindluse või kupongi vastu loomaaia poes, kohvikutes või väravas.',
            'remember' => 'Jära mind meelde',
            'btn' => [
                'login' => 'Logi sisse',
                'reset' => 'Unustasid salasõna?',
                'google' => 'Google',
                'facebook' => 'Facebook',
                'email' => 'Sign in with E-mail',
                'register-account' => 'Register Account',
            ],
            'choose-login-method'=> 'Choose login method',
            'or' => 'or',
        ],
    ],
    'register' => [
        'form' => [
            'heading' => 'Registreeru',
            'name' => 'Nimi',
            'btn' => [
                'register' => 'Registreeru',
            ],
            'labels' => [
                'agree-to-terms-and-policy' => 'Agree to <a href=":terms" target="_blank">terms and conditions</a> and <a href=":policy" target="_blank">privacy policy</a>',
            ],
        ],
    ],
    'reset' => [
        'form' => [
            'heading' => 'Lähtesta salasõna',
            'btn' => [
                'send-password-reset-link' => 'Saada salasõna lähtestamine link',
                'reset-password' => 'Lähtesta salasõna',
            ],
        ],
    ],
    'logout' => [
        'form' => [
            'btn' => [
                'logout' => 'Logi välja',
            ],
        ],
    ],

];
