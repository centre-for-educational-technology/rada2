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
                'heading' => 'Mis on RADA?',
                'content' => 'RADA on asukohapõhine mäng, mis võimaldab mängijatel osa võtta loovast ja koostööle orienteeritud teadmiste loomisest läbi mängustamise ja interaktiivsete ülesannete.',
            ],
            'schools' => [
                'heading' => 'RADA koolidele',
                'content' => 'RADA pakub võimaluse viia õppetöö klassiruumist välja ning koostada mängulisi tegevusi asukohapõhiste õpperadade näol.',
            ],
        ],
        'choose-location' => 'Vali asukoht',
        'btn' => [
            'play-smart-zoos' => 'Mängima',
        ],
        'project-information' => 'RADA ühendab Kesk-Läänemeremaade loomaaiad ühiseks turismi atraktsiooniks läbi mobiilse seikluspõhise teenuste paketi.',
    ],
    'activities' => [
        'index' => [
            'heading' => 'Rajad',
            'none-found' => 'Ühtegi rada ei leitud.',
            'promoted' => 'Avalikud mängud',
            'my_games' => 'Minu mängud',
            'templates' => 'Mallid'
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
            'tooltips' => [
                'answering-time' => 'Piirake vastamise aega'
            ],
            'help' => [
                'answering_time' => 'Vastamise aja vorming: 1h 1m 55s'
            ],
        ]
    ],
    'discount-vouchers' => [
        'index' => [
            'heading' => 'Kupongid',
            'none-found' => 'Ühtegi kupongi ei leitud.',
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
                'block-account' => 'Blokeeri',
                'unblock-account' => 'Eemalda blokeering',
                'delete-account' => 'Kustuta',
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
            'activities' => 'Rajad',
            'activity-items' => 'Rajapunktid',
            'games' => 'Mängud',
            'discount-vouchers' => 'Kupongid',
            'blocked-users' => 'Blokeeritud',
            'unverified-users' => 'Kinnitamata',
            'download-csv' => 'Eksprodi mänguandmed',
            'last-week' => 'Eelmine nädal',
            'last-month' => 'Eelmine kuu',
            'max' => 'Maksimum',
            'top-games' => 'Top 10 mängu',
            'captions' => [
                'activities-by-zoo' => 'Mändug loomaaedade kaupa',
                'activities-by-language' => 'Mängud keele alusel',
                'activity-items-by-zoo' => 'Rajapunktid loomaaedade järgi',
                'activity-items-by-question-type' => 'Rajapunktid küsimuse tüübi alusel',
                'activity-items-by-language' => 'Rajapunktid keele alusel',
                'games-by-status' => 'Mängud staatuse järgi',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Kuponge kokku',
                'discount-vouchers-redeemed' => 'Lunastatud',
            ],
        ],
        'game' => [
            'exercises-and-points' => 'Mäng sisaldab: :exercises ülesannet / :points punkti',
            'player-summary' => [
                'title' => 'Mängija kokkuvõte',
                'place' => 'Koht',
                'player' => 'Mängija',
                'points' => 'Punktid',
                'time' => 'Kulunud aeg',
                'nr-exercises' => 'Number ülesandeid',
                'answered' => 'Vastatud',
                'graded' => 'Hinnatud',
                'not-graded' => 'Hindamata',
                'at' => ''
            ],
            'exercise-summary' => [
                'title' => 'Ülesannete kokkuvõte',
                'exercise' => 'Ülesanne',
                'answered' => 'Vastatud',
                'graded' => 'Hinnatud',
                'not-graded' => 'Ei ole hinnatud',
                'total' => 'Kokku',
                'average' => 'Keskmine',
                'min' => 'Min',
                'max' => 'Max',
                'player' => 'Mängija staatus',
                'points' => 'Punktid',
                'time-spent' => 'Aega kulutatud',
                'type-title' => 'Ülesande tüüp',
                'flash-title' => 'Välk ülesanne',
                'time-title' => 'Aja piiranguga ülesanne'
            ],
            'tasks' => [
                'title' => 'Ülesanded',
                'points' => 'Punktid',
                'answer-from' => 'Vastas',
                'graded' => 'Hinnatud',
                'not-graded' => 'Ei ole hinnatud',
                'select-all-players' => 'Vali kõik mängijad',
                'select-all-tasks' => 'Vali kõik ülesanded',
                'filter' => 'Filter'
            ]
        ]
    ],
    'play' => [
        'game' => [
            'loading' => 'Mäng laeb ...',
            'its-you' => 'See oled sina',
            'info' => 'Mängu info',
            'position-tracking' => 'Lülita sisse või keela positsioneerimine',
            'exit' => 'Välju mängust',
            'exit-confirmation' => 'Oled sa kindel, et soovid mängust lahkuda? Ainult registreerunud kasutajad saavad mängu jätkata.',
            'change-map-type' => 'Muuta kaardi tüüpi',
            'textual-answer-placeholder' => 'Vastuse tekst...',
            'image-format-hint' => 'Palun kasuta ainult PNG või JPG/JPEG formaadis pilte.',
            'apply-item-bounds' => 'Kuva kaardil kõik rajapunktid',
            'results-heading' => 'Need on sinu tulemused',
            'stopped-heading' => 'Mäng on peatatud',
            'task-is-pending-an-evaluation' => 'Ülesanne ootab hindamist',
            'number-of-questions' => 'Küsimuste arv',
            'gps-error' => 'GPS signaal puudub.',
            'go' => 'Mängima!',
            'back' => 'Tagasi',
            'next' => 'Järgmine',
            'got-it' => 'Sain aru!',
            'read-more-about' => 'Lisainfo ...',
            'tips-text' => 'Mõned näpunäited enne alustamist',
            'access-code-placeholder' => 'Sisesta kood, et vastata küsimusele ilma positsioneerimise piiranguta',
            'not-logged-in' => 'Ei ole sisse logitud',
            'complete' => 'Lõpetatud!',
            'remaining_time' => 'Alles jäänud aega',
            'flash-exercises-list-modal-title' => 'Välk ülesanded',
            'flash-exercise-has-been-deactivated' => 'Ülesanne on deaktiveeritud. Enam ei ole võimalik küsimusele vastata.',
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
                    'description' => 'Uuri ümbrust, leia ja lõpeta kõik ülesanded!',
                ],
                'look_closely' => [
                    'title' => 'Vaata enda ümber',
                    'description' => 'Jälgi tähelepanelikult ümbrust võimalike vihjete leidmiseks. Ei või iial teada, kust vastuseid leida!',
                ],
                'look_out' => [
                    'title' => 'Vaata ette!',
                    'description' => 'Ole ettevaatlik, kuhu astud, et ei teeks liiga endale ega teistele',
                ],
                'do_not_disturb' => [
                    'title' => 'Ära lärma',
                    'description' => 'Võit on tore, kuid ära hirmuta loomi',
                ],
                'help_others' => [
                    'title' => 'Aidake üksteist',
                    'description' => 'Aita oma sõpru ja veetke koos meeldivalt aega!',
                ],
                'answering_time' => [
                    'description' => 'Sellel küsimusel on ajaline piirang. Küsimuse vaatamiseks klõpsake nuppu "Alusta".',
                    'start_timer' => 'Alusta',
                    'time_is_up' => 'Aeg mis oli mõeldud selle küsimuse vastamiseks sai läbi.'
                ]
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
            'download-player-positions' => 'Lae alla mängija positsioonid',
        ],
    ],
    'profile' => [
        'title' => 'Profiil',
        'heading' => 'Kasutaja: :name',
        'labels' => [
            'badges-earned' => 'õpimärki omandatud',
            'discount-vouchers-earned' => 'Teenitud kupongid',
            'valid-until' => 'Kehtib kuni',
        ],
        'confirmations' => [
            'discount-voucher-spend' => 'Kas Sa oled kindel, et soovid kupongi ära kulutada?',
        ],
        'discount-vouchers' => [
            'information' => 'Kuponge on võimalik omandada teatud mängude lõpetamisel. Näita omandatud kupongi töötajale auhinna omandamiseks. Kõik kupongid kehtivad teatud ajaperioodi.',
            'how-to-redeem' => 'Lase palun töötajal vajutada nuppu oma valiku kinnitamiseks. Seda tegevust ei saa tagasi võtta.',
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
    'grading' => [
        'index' => [
            'heading' => 'Hindamine',
            'none-found' => 'Midagi ei ole hinnata',
            'graded' => 'Hinnatud',
            'switch-label' => 'Näita hinnatud küsimusi',
            'grading-info' => 'Saad sisestada väärtusei vahemikus 0 ja',
            'success' => 'Edukalt salvestatud',
            'go-back-to-list' => 'Mine tagasi nimekirja',
            'submit-grade' => 'Salvesta',
            'heading-answer' => 'Vastus',
            'heading-grade' => 'Hinne',
            'heading-question-information' => 'Küsimus/Informatsioon',
            'heading-previous-grades' => 'Eelnevalt hinnatud',
            'details-btn' => 'Detailid',
            'question-type' => 'Küsimuse tüüp',
            'answer_table' => [
                'option' => 'Valik',
                'correct' => 'Õige vastus',
                'answer' => 'Vastus',
                'points' => 'Punktid',
                'image' => 'Pilt'
            ]
        ]
    ]

];
