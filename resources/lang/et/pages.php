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
            'information' => [
                'heading' => 'Mis on SmartZoos?',
                'content' => 'SmartZoos is a location-based game service, where the activities will guide you throughout your environment and teach you a thing or two.',
            ],
            'schools' => [
                'heading' => 'SmartZoos for Schools',
                'content' => 'Move the classroom to the great outdoors!<br>SmartZoos is a modern way to combine school with gamified fun. With a Creator account, you can create fun and activities to be used by you and other SmartZoos users.',
            ],
        ],
        'choose-location' => 'Vali asukoht',
        'btn' => [
            'play-smart-zoos' => 'Mängima',
        ],
        'project-information' => 'SmartZoos integrates the zoos of the CB region to form a joint tourist attraction through developing, implementing and joint marketing of a cross-border service package of creative adventure learning with mobile devices.',
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
    'discount-vouchers' => [
        'index' => [
            'heading' => 'Discount Vouchers',
            'none-found' => 'No Discount Vouchers could be found.',
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
                'block-account' => 'Block',
                'unblock-account' => 'Unblock',
                'delete-account' => 'Delete',
                'confirmations' => [
                    'role' => 'Oled sa kindel, et soovid rolli eemaldada?',
                ],
                'modal' => [
                    'title' => 'Halda kasutajate rolle',
                ],
            ]
        ],
        'statistics' => [
            'heading' => 'Statistika',
            'users' => 'Kasutajad',
            'activities' => 'Activities',
            'activity-items' => 'Activity Items',
            'games' => 'Mängud',
            'discount-vouchers' => 'Kupongid',
            'blocked-users' => 'Blokeeritud',
            'unverified-users' => 'Kinnitamata',
            'captions' => [
                'activities-by-zoo' => 'Activities by Zoo',
                'activities-by-language' => 'Activities by Language',
                'activity-items-by-zoo' => 'Activity Items by Zoo',
                'activity-items-by-question-type' => 'Activity Items by Question Type',
                'activity-items-by-language' => 'Activity Items by Language',
                'games-by-status' => 'Games by Status',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Kuponge kokku',
                'discount-vouchers-redeemed' => 'Redeemed',
            ],
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
            'change-map-type' => 'Change map type',
            'textual-answer-placeholder' => 'Vastuse tekst...',
            'image-format-hint' => 'Palun kasuta ainult PNG või JPG/JPEG formaadis pilte.',
            'apply-item-bounds' => 'Kuva kaardil kõik rajapunktid',
            'results-heading' => 'Need on sinu tulemused',
            'number-of-questions' => 'Küsimuste arv',
            'gps-error' => 'GPS signaal puudub.',
            'go' => 'Mängima!',
            'back' => 'Tagasi',
            'next' => 'Järgmine',
            'got-it' => 'Sain aru!',
            'read-more-about' => 'Lisainfo ...',
            'tips-text' => 'Mõned näpunäited enne alustamist',
            'access-code-placeholder' => 'Please enter the code or text to override positional restriction',
            'not-logged-in' => 'Ei ole sisse logitud',
            'complete' => 'Lõpetatud!',
            'icons' => [
                'help' => 'Igal ikoonil on värvikood, mis näitab, milline on küsimuse staatus.',
                'active' => 'Vastamata',
                'inactive' => 'Liiga kaugel',
                'correct' => 'Õige',
                'incorrect' => 'Vale vastus',
            ],
            'items' => [
                'gameplay_instructions' => [
                    'title' => 'Kuidas mängida',
                    'description' => 'Investigate the location, find and complete all the tasks!',
                ],
                'look_closely' => [
                    'title' => 'Vaata enda ümber',
                    'description' => 'Look closely at your surroundings for clues. You never know where you\'ll find answers!',
                ],
                'look_out' => [
                    'title' => 'Vaata ette!',
                    'description' => 'Be mindful of where you\'re going so you don\'t hurt yourself or others',
                ],
                'do_not_disturb' => [
                    'title' => 'Ära lärma',
                    'description' => 'Victory is nice, but don\'t scare the animals',
                ],
                'help_others' => [
                    'title' => 'Aidake üksteist',
                    'description' => 'Help your friends and have fun together!',
                ],
            ],
            'vouchers' => [
                'heading' => 'Oled saanud kupongi!',
                'details' => 'Täpsemat info leiad',
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
        'heading' => 'Mängu <strong>:title</strong> tulemused',
        'btn' => [
            'download-player-positions' => 'Download player positions',
        ],
    ],
    'profile' => [
        'title' => 'Profiil',
        'heading' => 'Kasutaja: :name',
        'labels' => [
            'badges-earned' => 'õpimärki omandatud',
            'discount-vouchers-earned' => 'Discount Vouchers Earned',
            'valid-until' => 'Valid until',
        ],
        'confirmations' => [
            'discount-voucher-spend' => 'Are you sure you want to spend this Discount Voucher?',
        ],
        'discount-vouchers' => [
            'information' => 'Vouchers are rewarded for completing Activities. Show the voucher to the staff to redeem. All vouchers are valid for a certain period of time and could only be redeemed within a certain time frame.',
            'how-to-redeem' => 'Please let the staff member press the button and confirm the process. This can not be undone.',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Kui sa ei soovi salasõna muuta, jäta palun salasõna väli tühjaks.',
        ]
    ],
    'badges' => [
        'introduction' => [
            'general' => 'Täites kindlaid ülesandeid, omistatakse Sulle õpimärke.',
            'authenticated' => 'Kogutud õpimärke näed oma <a href=":profileUrl">profiili all</a>.',
            'guest' => 'Õpimärkide kogumiseks tuleb <a href=":loginUrl">sisse logida</a>.',
        ],
    ],

];
