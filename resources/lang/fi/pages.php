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
                'heading' => 'Mikä on SmartZoos?',
                'content' => 'SmartZoos is a location-based game service, where the activities will guide you throughout your environment and teach you a thing or two.',
            ],
            'schools' => [
                'heading' => 'SmartZoos for Schools',
                'content' => 'Move the classroom to the great outdoors!<br>SmartZoos is a modern way to combine school with gamified fun. With a Creator account, you can create fun and activities to be used by you and other SmartZoos users.',
            ],
        ],
        'choose-location' => 'Valitse paikka',
        'btn' => [
            'play-smart-zoos' => 'Pelaa SmartZoos',
        ],
        'project-information' => 'SmartZoos tuo Itämereä ympäröivat eläintarhat yhteiseksi matkailukohteeksi kehittämällä opettavia kännykkäpelejä.',
    ],
    'activities' => [
        'index' => [
            'heading' => 'Toiminnat',
            'none-found' => 'Toimintoja ei löytynyt.',
        ],
        'create-or-edit' => [
            'keywords' => 'Avainsanat',
            'items-found' => 'osiota löydetty',
            'tooltips' => [
                'proximity-check' => 'Päättää läheisyysvalvonnan käytöstä.',
            ],
            'help' => [
                'proximity' => 'Aseta läheisyyssäde ainoastaan jos oletusarvo :default m ei sovi.  Ehdotamme käyttää 25–100 m arvoa.  Jos oikeanpuolinen valintaruutu on tyhjä, peli ei valvo läheisyytta ollenkaan.',
            ],
        ],
    ],
    'activity-items' => [
        'index' => [
          'heading' => 'Tehtävät',
          'none-found' => 'Tehtäviä ei löytynyt.',
        ],
        'create-or-edit' => [
            'set-current-position' => 'Aseta tämänhetkinen sijainti',
            'geolocation-error' => 'Virhe: Sijainnin määritys ei toimi',
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
                'heading' => 'Käsittele käyttäjiä',
                'none-found' => 'Käyttäjiä ei löydy',
                'accounts' => 'Tilit',
                'roles' => 'Roolit',
                'manage-roles' => 'Käsittele rooleja',
                'remove-role' => 'Poista rooli',
                'block-account' => 'Block',
                'unblock-account' => 'Unblock',
                'confirmations' => [
                    'role' => 'Haluatko tosiaan poista valitun roolin?',
                ],
                'modal' => [
                    'title' => 'Käsittele käyttäjärooleja',
                ],
            ]
        ],
        'statistics' => [
            'heading' => 'Tilastot',
            'users' => 'Käyttäjät',
            'activities' => 'Toiminnat',
            'activity-items' => 'Tehtävät',
            'games' => 'Pelit',
            'discount-vouchers' => 'Vouchers',
            'captions' => [
                'activities-by-zoo' => 'Toiminnat eläintarhaa kohti',
                'activities-by-language' => 'Toiminnat kieltä kohti',
                'activity-items-by-zoo' => 'Tehtävät eläintarhaa kohti',
                'activity-items-by-question-type' => 'Tehtävät kysymyslajia kohti',
                'activity-items-by-language' => 'Tehtävät kieltä kohti',
                'games-by-status' => 'Pelit tilaa kohti',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Total vouchers',
                'discount-vouchers-redeemed' => 'Redeemed',
            ],
        ],
    ],
    'play' => [
        'game' => [
            'loading' => 'Peli haetaan',
            'its-you' => 'Sinä',
            'info' => 'Tiedot pelistä',
            'position-tracking' => 'Aktivoi/deaktivoi sijainnin määritystä.',
            'exit' => 'Katkaise peli',
            'exit-confirmation' => 'Haluatko tosiaan katkaista pelin?  Ainoastaan sisäänkirjaudetut pelaajat voivat jatkaa katkaistua peliä.',
            'change-map-type' => 'Change map type',
            'textual-answer-placeholder' => 'Vastausteksti…',
            'image-format-hint' => 'Ainoastaan JPEG- tai PNG-kuvia sallittu.',
            'apply-item-bounds' => 'Näytä kaikkien tehtävien sijainnit kartasta.',
            'results-heading' => 'Tulokset',
            'number-of-questions' => 'Kysymysten määrä',
            'gps-error' => 'GPS-signaali ei löydy.',
            'go' => 'Pelaa!',
            'back' => 'Back',
            'next' => 'Next',
            'got-it' => 'Got it!',
            'read-more-about' => 'Lue lisää…',
            'tips-text' => 'Some tips before you start',
            'access-code-placeholder' => 'Please enter the code or text to override positional restriction',
            'not-logged-in' => 'Not logged in',
            'complete' => 'Complete!',
            'icons' => [
                'help' => 'Jokaisen kuvakkeen väri osoitta sen tilaa.',
                'active' => 'Vastaamaton',
                'inactive' => 'Liian etäinen',
                'correct' => 'Oikein vastattu',
                'incorrect' => 'Väärin vastattu',
            ],
            'items' => [
                'gameplay_instructions' => [
                    'title' => 'How to play',
                    'description' => 'Investigate the location, find and complete all the tasks!',
                ],
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
            'vouchers' => [
                'heading' => 'You have received a voucher!',
                'details' => 'For details go to',
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Kojelauta',
        'heading' => 'Tervetullut, :name!',
        'none-found' => 'Pelejä ja toimintoja ei löydy.',
        'games-and-activities' => 'Pelit ja toiminnat',
        'finished' => 'Lopetettu :date',
        'started' => 'Aloitettu :date',
        'btn' => [
            'view-results' => 'Näytä tulokset',
            'continue' => 'Jatka',
        ],
    ],
    'activity-results-index' => [
        'title' => 'Toiminnat',
        'heading' => 'Toimintojen tulokset',
        'zoos' => 'Näytetyt toiminnat kuuluvat seuraaviin eläintarhoihin:',
    ],
    'activity-results' => [
        'heading' => '<strong>:title</strong> n tulokset',
        'btn' => [
            'download-player-positions' => 'Download player positions',
        ],
    ],
    'profile' => [
        'title' => 'Profiili',
        'heading' => ':name n profiili',
        'labels' => [
            'badges-earned' => 'Ansaitut arvomerkit',
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
            'password' => 'Jätä salasanakenttä tyhjäksi jos et aio vaihtaa salasanaa.',
        ]
    ],
    'badges' => [
        'introduction' => [
            'general' => 'By accomplishing certain tasks within SmartZoos, you will be rewarded with badges.',
            'authenticated' => 'The badges you have collected can be seen on your <a href=":profileUrl">Profile</a>.',
            'guest' => 'In order to collect badges, you must be <a href=":loginUrl">logged in</a>.',
        ],
    ],

];
