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
            ],
            'social-networks'=> 'Eller logga in via sociala nät.',
        ],
    ],
    'register' => [
        'form' => [
            'heading' => 'Registrera dig',
            'name' => 'Namn',
            'btn' => [
                'register' => 'Registrera',
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
