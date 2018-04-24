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
                'content' => 'SmartZoos on palvelu paikallistetuille peleille, missä toiminnat vievät sinut ympäristöösi ja saattavat opettaa asian tai toisen.',
            ],
            'schools' => [
                'heading' => 'SmartZoos kouluille',
                'content' => 'Siirrä luokkahuone ulos.<br>SmartZoos on nykyinen tapa yhdistää koulua ja pelillistämistä.  Hankimalla luojatilin, voit luoda huvittavia toimintoja itsellesi ja toisille SmartZoos-käyttäjille.',
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
            'heading' => 'Alennuskupongit',
            'none-found' => 'Alennuskuponkeja ei löytynyt.',
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
                'block-account' => 'Estä',
                'unblock-account' => 'Poista esto',
                'delete-account' => 'Poista',
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
            'discount-vouchers' => 'Kupongit',
            'blocked-users' => 'Estetty',
            'unverified-users' => 'Todennematon',
            'captions' => [
                'activities-by-zoo' => 'Toiminnat eläintarhaa kohti',
                'activities-by-language' => 'Toiminnat kieltä kohti',
                'activity-items-by-zoo' => 'Tehtävät eläintarhaa kohti',
                'activity-items-by-question-type' => 'Tehtävät kysymyslajia kohti',
                'activity-items-by-language' => 'Tehtävät kieltä kohti',
                'games-by-status' => 'Pelit tilaa kohti',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Kaikki kupongit',
                'discount-vouchers-redeemed' => 'lunastetut',
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
            'change-map-type' => 'Vaihda kartttatyyppiä',
            'textual-answer-placeholder' => 'Vastausteksti…',
            'image-format-hint' => 'Ainoastaan JPEG- tai PNG-kuvia sallittu.',
            'apply-item-bounds' => 'Näytä kaikkien tehtävien sijainnit kartasta.',
            'results-heading' => 'Tulokset',
            'number-of-questions' => 'Kysymysten määrä',
            'gps-error' => 'GPS-signaali ei löydy.',
            'go' => 'Pelaa!',
            'back' => 'Palaa',
            'next' => 'Seuraava',
            'got-it' => 'Ymmärrän!',
            'read-more-about' => 'Lue lisää…',
            'tips-text' => 'Joitakin vihjeitä ennen alkua',
            'access-code-placeholder' => 'Anna koodi tai salasana ohittaaksen paikallisvalvonnan',
            'not-logged-in' => 'Ei ole kirjautunut sisään',
            'complete' => 'Valmis!',
            'icons' => [
                'help' => 'Jokaisen kuvakkeen väri osoitta sen tilaa.',
                'active' => 'Vastaamaton',
                'inactive' => 'Liian etäinen',
                'correct' => 'Oikein vastattu',
                'incorrect' => 'Väärin vastattu',
            ],
            'items' => [
                'gameplay_instructions' => [
                    'title' => 'Miten pelata',
                    'description' => 'Tutki paikkaa, löydä ja selvitä kaikki tehtävät.',
                ],
                'look_closely' => [
                    'title' => 'Katso ympäri',
                    'description' => 'Etsi johtolankoja tarkasti.  Et koskaan tiedä missä vastaus piilee.',
                ],
                'look_out' => [
                    'title' => 'Varo!',
                    'description' => 'Katso minne kuljet jotta et satuta itseäsi tai toisia.',
                ],
                'do_not_disturb' => [
                    'title' => 'Älä kilju!',
                    'description' => 'On mukava voittaa, mutta älä peloita eläimiä.',
                ],
                'help_others' => [
                    'title' => 'Auta toisia',
                    'description' => 'Auta ystäväsiä ja pitäkää yhdessä hauskaa.',
                ],
            ],
            'vouchers' => [
                'heading' => 'Sait kupongin!',
                'details' => 'Lue lisää:',
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
            'download-player-positions' => 'Hae pelaajien paikat',
        ],
    ],
    'profile' => [
        'title' => 'Profiili',
        'heading' => ':name n profiili',
        'labels' => [
            'badges-earned' => 'Ansaitut arvomerkit',
            'discount-vouchers-earned' => 'Ansaitut kupongit',
            'valid-until' => 'Voimassa kunnes ',
        ],
        'confirmations' => [
            'discount-voucher-spend' => 'Haluatko tosiaan käyttää tätä alennuskuponkia?',
        ],
        'discount-vouchers' => [
            'information' => 'Kuponkeja myönnettä toimintojen suorittamisesta.  Lunasta  kuponki näyttämällä se henkilökunnalle.  Kaikki kupongit kelpaavat vain tietyn ajan ja pitää lunastaa tietyn ajan sisällä.',
            'how-to-redeem' => 'Anna toimihenkilön painaa nappia ja vahvistaa lunastuksen. Tätä ei voi perua.',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Jätä salasanakenttä tyhjäksi jos et aio vaihtaa salasanaa.',
        ]
    ],
    'badges' => [
        'introduction' => [
            'general' => 'Suorittamalla tiettyjä tehtäviä SmartZoossa, saat arvomerkkejä.',
            'authenticated' => 'Keräämäsi arvomerkit näkyvät  <a href=":profileUrl">profiilissasi</a>.',
            'guest' => 'Kerätääksen arvomerkkejä sinun täytyy  <a href=":loginUrl">kirjautua sisään</a>.',
        ],
    ],

];
