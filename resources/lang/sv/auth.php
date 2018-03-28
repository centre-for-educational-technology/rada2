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

    'failed' => 'Användarnamn eller lösenord stämmer inte.',
    'throttle' => 'Alltför många inloggningsförsök. Försök igen om :seconds sekunder.',
    'general' => [
        'email' => 'Epostadress',
        'password' => 'Lösenord',
        'confirm-password' => 'Bekräfta lösenord',
        'captcha' => 'CAPTCHA',
    ],
    'login' => [
        'form' => [
            'heading' => 'Logga in',
            'text' => 'Vandra igenom parken och svara på frågor.',
            'remember' => 'Kom ihåg mig.',
            'btn' => [
                'login' => 'Logga in',
                'reset' => 'Har du glömt ditt lösenord?',
                'google' => 'Logga in som din Google-identitet.',
                'facebook' => 'Logga in som din Facebook-identitet.',
                'email' => 'Logga in med din epostadress.',
                'register-account' => 'Registrera användare',
            ],
            'choose-login-method'=> 'Välj inloggningsmetod',
            'or' => 'eller',
        ],
    ],
    'register' => [
        'form' => [
            'heading' => 'Registrera dig',
            'name' => 'Namn',
            'btn' => [
                'register' => 'Registrera',
            ],
            'labels' => [
                'agree-to-terms-and-policy' => 'Agree to <a href=":terms" target="_blank">terms and conditions</a> and <a href=":policy" target="_blank">privacy policy</a>',
            ],
        ],
    ],
    'reset' => [
        'form' => [
            'heading' => 'Återställ lösenordet',
            'btn' => [
                'send-password-reset-link' => 'Skicka en länk för att återställa lösenordet.',
                'reset-password' => 'Återställ lösenordet',
            ],
        ],
    ],
    'logout' => [
        'form' => [
            'btn' => [
                'logout' => 'Logga ut',
            ],
        ],
    ],

];
