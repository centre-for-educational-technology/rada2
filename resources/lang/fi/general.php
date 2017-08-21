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

   'activity-type' => [
       'collecting-cards' => 'Keräyskortit',
       'treasure-hunt' => 'Aarrejahti',
   ],
   'activity-status' => [
       'complete' => 'Valmis toiminta',
       'ongoing' => 'Jatkuva toiminta',
   ],
   'language' => 'Kieli',
   'languages' => [
       'en' => 'English',
       'et' => 'Eesti keel',
       'ru' => 'По-русски',
       'fi' => 'Suomi',
       'swe' => 'Svenska',
   ],
   'zoos' => [
     'skansen' => 'Skansen',
     'korkeasaari' => 'Korkeasaari',
     'tallinn' => 'Tallinn Zoo',
   ],
   'question-types' => [
     'one-correct-answer' => 'Vain yksi oikea vastaus',
     'multiple-correct-answers' => 'Useampi oikea vastaus',
     'freeform-answer' => 'Vapaatextivastaus',
     'match-pairs' => 'Parisovitus',
     'embedded-content' => 'Sulautettua sisältöä',
     'photo' => 'Kuva',
     'information' => 'Informaatiota',
   ],
   'forms' => [
       'labels' => [
           'activity-type' => 'Toimintatyyppi',
           'title' => 'Otsikko',
           'description' => 'Selitys',
           'difficulty-level' => 'Vaikeusaste',
           'playing-time' => 'Peliaika',
           'contact-information' => 'Yhteystiedot',
           'featured-image' => 'Otsikkokuva',
           'zoo' => 'Eläintarha',
           'question-type' => 'Kysymyslaji',
           'location' => 'Paikka',
           'activity-items' => 'Tehtävä',
           'proximity' => 'Läheisyys',
           'search-text' => 'Etsi tekstiä',
           'read-more' => 'Lue lisää',
           'image' => 'Kuva',
       ],
       'help' => [
           'playing-time' => 'Toimintaaika minuuteissa',
           'difficulty-level' => 'Valitse sopiva väli arvoista. Oletus on kaikki arvot.',
           'image' => 'Kuva JPEG- tai PNG-muodossa.  Ladattu kuva muutetaan kokoon 800×800 pistettä.',
           'map' => 'Valitse toivottu eläintarha ja vedä osoitin tahdottuun pisteeseen.',
           'question-types' => [
               'information' => 'Selitysteksti näytetään tietona paikasta..',
               'freeform-answer' => 'Tekstisyöttöalue näytetään pelaajalle.',
               'embedded-content' => 'Sulautettu HTML-koodi lisätty tekstisyöttöalueeseen näytetään pelaajalle.',
               'photo' => 'Pelaaja voi ladata kuvan vastaukseksi.',
           ],
       ],
       'buttons' => [
           'create' => 'Luo',
           'save' => 'Tallenna',
           'cancel' => 'Kumoa',
           'close' => 'Sulje',
           'submit' => 'Lähetä',
           'search' => 'Etsi',
           'add-activity-items' => 'Lisää tehtäviä',
           'load-more' => 'Lataa lisää',
           'add-option' => 'Lisää vaihtoehto',
           'reset' => 'Palauta',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Syötä avainsana tai otsikko',
           'option-text' => 'Valintateksti',
           'embedded-content' => 'Syötä sulautetti HTML-koodi tähän.',
           'search-text' => 'Syötä etsittävä teksti',
           'read-more' => 'Syötä URL jossa löytyy lisää tietoja aiheesta.',
       ],
       'options' => [
           'any' => 'Joku',
       ]
   ],
   'actions' => [
       'create' => 'Luo',
       'edit' => 'Muokkaa',
       'delete' => 'Poista',
       'play' => 'Pelaa',
       'send-to-backpack' => 'Lähetä reppuun',
       'download-baked-badge' => 'Hae arvomerkkikuva',
       'assertion-open' => 'Aukaise arvomerkkilinkki',
   ],
   'minutes' => 'minuuttia',
   'confirmations' => [
       'delete' => 'Haluatko tosiaan poistaa tämän tehtävän?',
   ],
   'date-time' => [
       'formats' => [
           'short' => 'F d, Y',
           'medium' => 'F d, Y H:i',
           'long' => 'F d, Y, H:i:s',
       ],
       'created-at' => 'Luotu',
       'updated-at' => 'Päivitetty',
   ],
   'roles' => [
       'admin' => 'Ylläpitäjä',
       'zooAdmin' => 'Ylläpitäjä',
       'zooMember' => 'Jäsen',
   ],
];
