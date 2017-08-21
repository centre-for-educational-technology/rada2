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
            'captions' => [
                'activities-by-zoo' => 'Sorterade per djurpark',
                'activities-by-language' => 'Sorterade per språk',
                'activity-items-by-zoo' => 'Uppgifter sorterade per djurpark',
                'activity-items-by-question-type' => 'Uppgifter sorterade per frågetyp',
                'activity-items-by-language' => 'Uppgifter sorterade per språk',
                'games-by-status' => 'Spel sorterade per tillstånd.',
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
            'textual-answer-placeholder' => 'Svarstext…',
            'image-format-hint' => 'Endast JPEG- eller PNG-bilder tillåtna.',
            'apply-item-bounds' => 'Visa alla uppgifter på kartan.',
            'results-heading' => 'Dina resultat',
            'number-of-questions' => 'Antal frågor',
            'gps-error' => 'Ingen GPS-signal.',
            'go' => 'Starta!',
            'read-more-about' => 'Läs mer om…',
            'icons' => [
                'help' => 'Varje ikons färg visar uppgiftens tillstånd.',
                'active' => 'Obesvarad',
                'inactive' => 'Utom räckhåll',
                'correct' => 'Rätt svar',
                'incorrect' => 'Fel svar',
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
        'heading' => ':title, resultat',

    ],
    'profile' => [
        'title' => 'Profil',
        'heading' => ':name s profil',
        'labels' => [
            'badges-earned' => 'Vunna märken',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Lämna lösenordfältet tomt om du inte vill ändra det.',
        ]
    ],

];
