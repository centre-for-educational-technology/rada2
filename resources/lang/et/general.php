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

   'activity-status' => [
       'complete' => 'Lõpeta mäng',
       'ongoing' => 'Käimasolev mäng',
       'stopped' => 'Peatatud mäng'
   ],
   'discount-voucher-status' => [
       'inactive' => 'Mitte aktiivne',
       'active' => 'Aktiivne',
   ],
   'language' => 'Keel',
   'languages' => [
       'en' => 'Inglise',
       'et' => 'Eesti',
       'ru' => 'Vene',
       'fi' => 'Soome',
       'sv' => 'Rootsi',
   ],
   'zoos' => [
     'skansen' => 'Skansen',
     'korkeasaari' => 'Korkeasaari',
     'tallinn' => 'Tallinna Loomaaed',
   ],
   'question-types' => [
     'one-correct-answer' => 'Üks õige vastus',
     'multiple-correct-answers' => 'Mitu õiget vastust',
     'freeform-answer' => 'Vabas vormis vastus',
     'match-pairs' => 'Leia paarid',
     'embedded-content' => 'Vistutatud sisu',
     'photo' => 'Foto',
     'information' => 'Informatsioon',
       'missing-word' => 'Puuduv sõna'
   ],
   'forms' => [
       'labels' => [
           'title' => 'Pealkiri',
           'description' => 'Kirjeldus',
           'game-story-and-rules' => 'Mängu lugu ja reeglid',
           'difficulty-level' => 'Raskusaste',
           'playing-time' => 'Raja läbimiseks kuluv aeg',
           'contact-information' => 'Kontakt',
           'featured-image' => 'Kaanepilt',
           'zoo' => 'Loomaaed',
           'question-type' => 'Küsimuse tüüp',
           'location' => 'Asukoht',
           'activity-items' => 'Rajapunktid',
           'proximity' => 'Kaugus',
           'search-text' => 'Otsi teksti',
           'read-more' => 'Lisainfo',
           'image' => 'Pilt',
           'duration' => 'Kestus',
           'status' => 'Staatus',
           'discount-voucher' => 'Allahindluse kupong',
           'access-code' => 'Ligipääsu kood',
           'access-code-clues' => 'Ligipääsu koodi vihjed',
           'amount' => 'Kogus',
           'hide-incognito' => 'Peida anonüümsed',
           'hide-incomplete' => 'Peida lõpetamata',
           'from' => 'Alates',
           'until' => 'Kuni',
           'question-or-information' => 'Küsimus/informatsioon',
           'promoted' => 'Avatud mäng, mängijad saavad liituda mänguga teadmata pin koodi.',
           'is_template' => 'Mall',
           'pin-code' => 'Mängu PIN kood. Jaga PIN koodi mängijatega, et nad saaksid mängule ligi',
           'keywords' => 'Märksõnad',
           'enforce_items_order' => 'Rakendage üksuste järjekord',
           'subject' => 'Teemad',
           'age_of_participants' => 'Osalejate vanus',
           'answering_time' => 'Vastamise aja limiit',
           'instructors' => 'Istruktorid',
           'maximum-points-available' => 'Maksimaalne saadaolevate punktide arv',
           'maximum-points-available-missing-word' => 'Täiesti õiged vastused hinnatakse automaatselt, ülejäänud vajavad käsitsi hindamist.',
           'is-flash' => 'Välk ülesanne',
           'time' => [
               'hour' => 'H',
               'minute' => 'm',
               'second' => 's'
           ]
       ],
       'help' => [
           'playing-time' => 'Raja läbimiseks kuluv aeg minutites',
           'image' => 'Sobiv formaat on kas JPEG või PNG. Üleslaetud pilt vähendatakse mõõtu 800 x 800 pikslit.',
           'map' => 'Palun vali sobiv loomaaed ja lohista marker õigesse asukohta.',
           'question-types' => [
               'information' => 'Kirjeldav tekst mängu kohta.',
               'freeform-answer' => 'Mängijale kuvatakse tekstikasti sisestaud tekstI.',
               'embedded-content' => 'Mängijale kuvatakse vistutatud koodi taga olev meediaobjekt.',
               'photo' => 'Mängija postitab vastuseks foto.',
               'missing-word' => 'Lisage sulud puuduvate sõnade ümber. Näiteks "Eesti pealinn on {Tallinn}".'
           ],
           'keywords' => 'Eralda märksõnad komaga',
           'instructors' => 'Kasutajaid saab otsida nime ja e-posti järgi.'
       ],
       'buttons' => [
           'create' => 'Loo',
           'save' => 'Salvesta',
           'cancel' => 'Tühista',
           'close' => 'Sulge',
           'open' => 'Ava',
           'submit' => 'Saada',
           'search' => 'Otsi',
           'load-more' => 'Lae veel',
           'add-option' => 'Lisa valik',
           'reset' => 'Lähtesta',
           'apply-filters' => 'Sea filtrid',
           'search-activity-items' => 'Otsi rajapunkte',
           'create-new-activity-item' => 'Loo uus rajapunkt',
           'login-or-register' => 'Logi sisse/registreeru',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Märksõna või pealkiri',
           'option-text' => 'Valikute tekst...',
           'embedded-content' => 'Lisa vistutatav kood siia',
           'search-text' => 'Otsimiseks sisesta tekstiosa',
           'read-more' => 'Sisesta veebiaadress kust leiab rohkem infot',
           'name-or-email' => 'Nimi või e-posti aadress',
           'access-code' => 'Kood või tekst mille abil saab vastata ilma vahetuses läheduses viibimata',
           'access-code-clues' => 'Vihjed sellele mis Kood olla võiks või kust seda leiab',
           'datetime' => 'Kuupäev või kuupäev ja kellaaeg',
           'question-or-information' => 'Palun kirjuta Küsimust või Lisainfot, sõltuvalt valitud küsimuse tüübist',
           'missing-word' => 'Sisesta puuduvate sõnadega tekst siia',
           'pin-placeholder' => 'INSERT PIN',
           'pts' => 'pkt',
           'enter-your-name' => 'Sisesta oma nimi siia'
       ],
       'options' => [
           'any' => 'Kõik',
       ],
       'addons' => [
           'hours' => 'tunnid',
           'awarded' => 'määratud',
       ],
       'tooltips' => [
           'remove-image' => 'Märgi olemasoleva pildi kustutamiseks',
           'remove-selected-image' => 'Eemalda valitud pilt',
           'mark-option-as-correct' => 'Märgi valik õigeks',
       ],
       'warnings' => [
           'readd-pictures' => 'Kui oled eelnevalt pilte lisanud, lisa need uuesti. Vabandame.',
           'no_results_found' => 'Selle päringu kohta tulemusi ei leitud!'
       ],
       'alerts' => [
           'image-loading-text' => 'Laen ...',
           'form-submit-loading-text' => 'Laen ...'
       ]
   ],
   'actions' => [
       'create' => 'Loo',
       'duplicate' => 'Genereeri duplikaat',
       'edit' => 'Muuda',
       'delete' => 'Kustuta',
       'play' => 'Mängi',
       'send-to-backpack' => 'Saada Backpacki',
       'download-baked-badge' => 'Lae alla õpimärgi pildifail',
       'assertion-open' => 'Open badge-i tõendi URL',
       'discount-voucher-spend' => 'Kuluta kupong',
       'get-qr-code' => 'Näita QR-koodi',
       'reveal-discount' => 'Näita kupongi',
       'mark-started' => 'Märgi mäng alustatuks',
       'mark-stopped' => 'Märgi mäng lõppenuks',
       'start' => 'Alusta',
       'stop' => 'Lõpta'
   ],
   'minutes' => 'minutid',
   'confirmations' => [
       'delete' => 'Oled sa kindek, et soovid selle kustutada?',
       'play' => 'Sa ei ole sisse loginud! - Sinu progressi ei salvestata ja auhindu (õpimärgid, kuponge) Sulle ei omistata.',
       'block-account' => 'Oled Sa kindel, et soovid blokeerida valitud kasutaja?',
       'unblock-account' => 'Oled Sa kindel, et soovid valitud konto uuesti avada?',
       'delete-account' => 'Oled Sa kindel, et soovid valitud kasutaja kustutada? Seda ei saa tagasi võtta ja selle käigus kustutatakse kogu kasutaja poolt loodud sisu!',
       'unload-protection' => 'Sul võib olla salvestamata tööd. Oled kindel, et soovid lahkuda?',
   ],
   'date-time' => [
       'formats' => [
           'short' => 'F d, Y',
           'medium' => 'F d, Y H:i',
           'long' => 'F d, Y, H:i:s',
       ],
       'created-at' => 'Loodud',
       'updated-at' => 'Viimati uuendatud',
   ],
   'roles' => [
       'admin' => 'Administraator',
       'zooAdmin' => 'Administraator',
       'zooMember' => 'Liige',
   ],
   'difficulty-level' => [
     'easy' => 'Lihtne',
     'medium' => 'Mõõdukas',
     'hard' => 'Raske',
   ],
   'cookie-consent' => [
       'text' => 'See veebileht kasutab küpsiseid Sinu mugavamaks teenindamiseks. Veebilehe kasutamiseks palun  <a href=":policy" target="_blank">nõustu küpsiste kasutamisega</a>.',
       'button-agree' => 'Nõustun',
   ],
   'system-requirements' => 'Miinimumnõuded: operatsioonisüsteem iOS (versioon 10) või Android 7. Vähemalt 3G kiirusega internetiühendus ja toimib GPS moodul on vajalik.',
   'messages' => [
       'warnings' => [
           'account-blocked' => 'Konto on blokeeritud. Pöördu palun halduri poole küsimustega.',
           'account-email-not-verified' => 'See konto ei ole veel verifitseeritud. Juhised on saadetud Sinu e-posti aadressile.',
       ],
       'successes' => [
           'account-email-verification-sent' => 'Sinu konto on loodud. Saatsime sinu e-posti peale kinnituskirja konto verifitseerimiseks.',
           'account-email-verified' => 'Sinu konto on edukalt verifitseeritud. Sa võid nüüd sisse logida.',
       ],
       'error' => [
           'game-not-found' => 'Mängu ei leitud',
           'invalid-pin-code' => 'Vigane pin kood',
           'missing-word' => 'Vähemalt ühe puuduva sõna peab sisestama'
       ],
       'notifications' => [
           'new-flash-message' => [
               'title' => 'Aktiveeriti välk ülesanne!',
               'message' => 'Välk ülesandeid saab lahendada piiratud aja jooksul. Tegutse kiirelt!'
           ]
       ]
   ],
    'activity' => [
        'subject' => [
            'arts' => 'Kunst',
            'biology' => 'Bioloogia',
            'Cchemistry' => 'Keemia',
            'crafts' => 'Käsitöö',
            'english' => 'Inglise keel',
            'ethics' => 'Eetika',
            'estonian' => 'Eesti keel',
            'french' => 'Prantsuse keel',
            'geography' => 'Geograafia',
            'german' => 'Saksa keel',
            'health_education' => 'Terviseharidus',
            'higher_education_studies' => 'Kõrghariduse uuringud',
            'history' => 'Ajalugu',
            'maths' => 'Matemaatika',
            'matural_sciences' => 'Loodusteadused',
            'other' => 'Muu',
            'philosophy' => 'Filosoofia',
            'physics' => 'Füüsika',
            'psychology' => 'Psühholoogia',
            'spanish' => 'Hispaania keel'
        ]
    ]
];
