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
            'heading' => 'Mis on SmartZoos?',
            'content' => 'SmartZoos integrates the zoos of the CB region to form a joint tourist attraction through developing, implementing and joint marketing of a cross-border service package of creative adventure learning with mobile devices.',
        ],
        'choose-location' => 'Vali asukoht',
        'btn' => [
            'play-smart-zoos' => 'Mängima',
        ],
    ],
    'activities' => [
        'index' => [
            'heading' => 'Rajad',
            'none-found' => 'Ühtegi rada ei leitud.',
        ],
        'create-or-edit' => [
            'keywords' => 'Märksõnad',
            'items-found' => 'leitud vastet',
            'tooltips' => [
                'proximity-check' => 'Teeb kindlaks, kas kauguse piirang on sisse lülitatud',
            ],
            'help' => [
                'proximity' => 'Määra kaugusepiirang meetrites ainult juhul kui vaikimisi väärtus :default ei ole sobiv. Soovituslik vahemik on 25 kuni 100 meetrit. Võttes maha linnukuse märkeruudust, on võimalik rada läbida ilma asukohapiiranguta.',
            ],
        ],
    ],
    'activity-items' => [
        'index' => [
          'heading' => 'Rajapunktid',
          'none-found' => 'Ühtegi rajapunkti ei leitud.',
        ],
        'create-or-edit' => [
            'set-current-position' => 'Määra praegune asukoht',
            'geolocation-error' => 'Viga: Asukohta ei õnnestunud tuvastada',
        ],
    ],
    'manage' => [
        'users' => [
            'index' => [
                'heading' => 'Halda kasutajaid',
                'none-found' => 'Ühtegi kasutajat ei leitud',
                'accounts' => 'Kontod',
                'roles' => 'Rollid',
                'manage-roles' => 'Halda rolle',
                'remove-role' => 'Eemalda roll',
                'confirmations' => [
                    'role' => 'Oled sa kindel, et soovid rolli eemaldada?',
                ],
                'modal' => [
                    'title' => 'Halda kasutajate rolle',
                ],
            ]
        ],
    ],
    'play' => [
        'game' => [
            'loading' => 'Mäng laeb ...',
            'its-you' => 'See oled sina',
            'info' => 'Mängu info',
            'position-tracking' => 'Lülita sisse või keela positsioneerimine',
            'exit' => 'Välju mängust',
            'exit-confirmation' => 'Oled sa kindel, et soovid mängust lahkuda? Ainult registreerunud kasutajad saavad mängu jätkata.',
            'textual-answer-placeholder' => 'Vastuse tekst...',
            'image-format-hint' => 'Palun kasuta ainult PNG või JPG/JPEG formaadis pilte.',
            'apply-item-bounds' => 'Kuva kaardil kõik rajapunktid',
            'results-heading' => 'Need on sinu tulemused',
            'number-of-questions' => 'Küsimuste arv',
            'gps-error' => 'GPS signaal puudub.',
            'go' => 'Mängima!',
            'read-more-about' => 'Read more about...',
            'icons' => [
                'help' => 'Igal ikoonil on värvikood, mis näitab, milline on küsimuse staatus.',
                'active' => 'Vastamata',
                'inactive' => 'Liiga kaugel',
                'correct' => 'Õige',
                'incorrect' => 'Vale vastus',
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Töölaud',
        'heading' => 'Tere tulemast, :name!',
        'none-found' => 'Ühtegi mängu ega tegevust ei leitud',
        'games-and-activities' => 'Mängud ja tegevused',
        'finished' => 'Lõpetatud :date',
        'started' => 'Alustatud :date',
        'btn' => [
            'view-results' => 'Vaata tulemusi',
            'continue' => 'Jätka',
        ],
    ],
    'activity-results-index' => [
        'title' => 'Mängud',
        'heading' => 'Mängude tulemused',
        'zoos' => 'Kuvatavad mängud kuuluvad järgmiste loomaaedade juurde',
    ],
    'activity-results' => [
        'heading' => 'Mängu :title tulemused',

    ],
    'profile' => [
        'title' => 'Profiil',
        'heading' => 'Kasutaja: :name',
        'labels' => [
            'badges-earned' => 'õpimärki omandatud',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Kui sa ei soovi salasõna muuta, jäta palun salasõna väli tühjaks.',
        ]
    ],

];
