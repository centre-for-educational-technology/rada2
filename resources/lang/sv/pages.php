<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pages Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used on various pages.
    |
    */

    'welcome' => [
        'jumbotron' => [
            'heading' => 'Vad är SmartZoos?',
            'content' => 'SmartZoos knyter samman djurparkerna i Östersjöområdet som en gemensam turistattraktion genom gemensamma pedagogiska mobilspel.',
        ],
        'choose-location' => 'Välj plats',
        'btn' => [
            'play-smart-zoos' => 'Spela',
        ],
    ],
    'activities' => [
        'index' => [
            'heading' => 'Aktiviteter',
            'none-found' => 'Inga aktiviteter hittade.',
        ],
        'create-or-edit' => [
            'keywords' => 'Nyckelord',
            'items-found' => 'hittade uppgifter.',
            'tooltips' => [
                'proximity-check' => 'Avgör om avståndsbedömning används',
            ],
            'help' => [
                'proximity' => 'Ställ endast om närhetsradien om standardinställningen :default m inte fungerar. Radien bör vara 25–100 m. Om du klickar ur rutan till höger kommer avståndsbedömning inte användas alls.',
            ],
        ],
    ],
    'activity-items' => [
        'index' => [
          'heading' => 'Uppgifter',
          'none-found' => 'Inga uppgifter hittade.',
        ],
        'create-or-edit' => [
            'set-current-position' => 'Ställ in nuvarande position.',
            'geolocation-error' => 'Fel: Positionen kan ej bestämmas.',
        ],
    ],
    'discount-vouchers' => [
        'index' => [
            'heading' => 'Discount Vouchers',
            'none-found' => 'No Discount Vouchers could be found.',
        ],
    ],
    'manage' => [
        'users' => [
            'index' => [
                'heading' => 'Hantera användare',
                'none-found' => 'Inga användare funna',
                'accounts' => 'Konton',
                'roles' => 'Roller',
                'manage-roles' => 'Hantera roller',
                'remove-role' => 'Ta bort roll',
                'confirmations' => [
                    'role' => 'Ta bort roll.  Är du säker?',
                ],
                'modal' => [
                    'title' => 'Hantera roller',
                ],
            ]
        ],
        'statistics' => [
            'heading' => 'Statistik',
            'users' => 'Användare',
            'activities' => 'Aktiviteter',
            'activity-items' => 'Uppgifter',
            'games' => 'Spel',
            'discount-vouchers' => 'Vouchers',
            'captions' => [
                'activities-by-zoo' => 'Sorterade per djurpark',
                'activities-by-language' => 'Sorterade per språk',
                'activity-items-by-zoo' => 'Uppgifter sorterade per djurpark',
                'activity-items-by-question-type' => 'Uppgifter sorterade per frågetyp',
                'activity-items-by-language' => 'Uppgifter sorterade per språk',
                'games-by-status' => 'Spel sorterade per tillstånd.',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Total vouchers',
                'discount-vouchers-redeemed' => 'Redeemed',
            ],
        ],
    ],
    'play' => [
        'game' => [
            'loading' => 'Spelet laddas…',
            'its-you' => 'Här är du',
            'info' => 'Spelinformation',
            'position-tracking' => 'Slå av/på positionsbestämning',
            'exit' => 'Avsluta spelet',
            'exit-confirmation' => 'Avsluta spelet.  Är du säker?  Endast inloggade användare kan fortsätta ett avslutat spel',
            'change-map-type' => 'Change map type',
            'textual-answer-placeholder' => 'Svarstext…',
            'image-format-hint' => 'Endast JPEG- eller PNG-bilder tillåtna.',
            'apply-item-bounds' => 'Visa alla uppgifter på kartan.',
            'results-heading' => 'Dina resultat',
            'number-of-questions' => 'Antal frågor',
            'gps-error' => 'Ingen GPS-signal.',
            'go' => 'Starta!',
            'back' => 'Back',
            'next' => 'Next',
            'got-it' => 'Got it!',
            'read-more-about' => 'Läs mer om…',
            'tips-text' => 'Some tips before you start:',
            'access-code-placeholder' => 'Please enter the code or text to override positional restriction',
            'icons' => [
                'help' => 'Varje ikons färg visar uppgiftens tillstånd.',
                'active' => 'Obesvarad',
                'inactive' => 'Utom räckhåll',
                'correct' => 'Rätt svar',
                'incorrect' => 'Fel svar',
            ],
            'items' => [
                'look_closely' => [
                    'title' => 'Look around',
                    'description' => 'Look closely at your surroundings for clues. You never know where you\'ll find answers!',
                ],
                'look_out' => [
                    'title' => 'Look out!',
                    'description' => 'Be mindful of where you\'re going so you don\'t hurt yourself or others',
                ],
                'do_not_disturb' => [
                    'title' => 'Don\'t be too loud',
                    'description' => 'Victory is nice, but don\'t scare the animals',
                ],
                'help_others' => [
                    'title' => 'Help each other',
                    'description' => 'Help your friends and have fun together!',
                ],
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Kontrollpanel',
        'heading' => 'Välkommen, :name!',
        'none-found' => 'Inga spel eller aktiviteter hittade.',
        'games-and-activities' => 'Spel och aktiviteter',
        'finished' => 'Avslutad :date',
        'started' => 'Påbörjad :date',
        'btn' => [
            'view-results' => 'Se resultat',
            'continue' => 'Fortsätt',
        ],
    ],
    'activity-results-index' => [
        'title' => 'Aktiviteter',
        'heading' => 'Aktiviteternas resultat',
        'zoos' => 'Aktiviteterna nedan hör till följande djurparker',
    ],
    'activity-results' => [
        'heading' => '<strong>:title</strong>, resultat',
        'btn' => [
            'download-player-positions' => 'Download player positions',
        ],
    ],
    'profile' => [
        'title' => 'Profil',
        'heading' => ':name s profil',
        'labels' => [
            'badges-earned' => 'Vunna märken',
            'discount-vouchers-earned' => 'Discount Vouchers Earned',
            'valid-until' => 'Valid until',
        ],
        'confirmations' => [
            'discount-voucher-spend' => 'Are you sure you want to spend this Discount Voucher?',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Lämna lösenordfältet tomt om du inte vill ändra det.',
        ]
    ],

];
