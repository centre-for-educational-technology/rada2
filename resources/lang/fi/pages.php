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
            'heading' => 'Mikä on SmartZoos?',
            'content' => 'SmartZoos tuo Itämereä ympäröivat eläintarhat yhteiseksi matkailukohteeksi kehittämällä opettavia kännykkäpelejä.',
        ],
        'choose-location' => 'Valitse paikka',
        'btn' => [
            'play-smart-zoos' => 'Pelaa SmartZoos',
        ],
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
    'manage' => [
        'users' => [
            'index' => [
                'heading' => 'Käsittele käyttäjiä',
                'none-found' => 'Käyttäjiä ei löydy',
                'accounts' => 'Tilit',
                'roles' => 'Roolit',
                'manage-roles' => 'Käsittele rooleja',
                'remove-role' => 'Poista rooli',
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
            'captions' => [
                'activities-by-zoo' => 'Toiminnat eläintarhaa kohti',
                'activities-by-language' => 'Toiminnat kieltä kohti',
                'activity-items-by-zoo' => 'Tehtävät eläintarhaa kohti',
                'activity-items-by-question-type' => 'Tehtävät kysymyslajia kohti',
                'activity-items-by-language' => 'Tehtävät kieltä kohti',
                'games-by-status' => 'Pelit tilaa kohti',
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
            'textual-answer-placeholder' => 'Vastausteksti…',
            'image-format-hint' => 'Ainoastaan JPEG- tai PNG-kuvia sallittu.',
            'apply-item-bounds' => 'Näytä kaikkien tehtävien sijainnit kartasta.',
            'results-heading' => 'Tulokset',
            'number-of-questions' => 'Kysymysten määrä',
            'gps-error' => 'GPS-signaali ei löydy.',
            'go' => 'Pelaa!',
            'read-more-about' => 'Lue lisää…',
            'icons' => [
                'help' => 'Jokaisen kuvakkeen väri osoitta sen tilaa.',
                'active' => 'Vastaamaton',
                'inactive' => 'Liian etäinen',
                'correct' => 'Oikein vastattu',
                'incorrect' => 'Väärin vastattu',
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
        'heading' => ':title n tulokset',

    ],
    'profile' => [
        'title' => 'Profiili',
        'heading' => ':name n profiili',
        'labels' => [
            'badges-earned' => 'Ansaitut arvomerkit',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Jätä salasanakenttä tyhjäksi jos et aio vaihtaa salasanaa.',
        ]
    ],

];
