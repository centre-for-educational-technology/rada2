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
       'complete' => 'Valmis toiminta',
       'ongoing' => 'Jatkuva toiminta',
   ],
   'discount-voucher-status' => [
       'inactive' => 'Inactive',
       'active' => 'Active',
   ],
   'language' => 'Kieli',
   'languages' => [
       'en' => 'English',
       'et' => 'Eesti keel',
       'ru' => 'По-русски',
       'fi' => 'Suomi',
       'sv' => 'Svenska',
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
           'duration' => 'Duration',
           'status' => 'Status',
           'discount-voucher' => 'Discount Voucher',
           'access-code' => 'Access Code',
           'amount' => 'Amount',
           'hide-incognito' => 'Hide incognito',
           'hide-incomplete' => 'Hide incomplete',
           'from' => 'From',
           'until' => 'Until',
           'question-or-information' => 'Question/Information',
       ],
       'help' => [
           'playing-time' => 'Toimintaaika minuuteissa',
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
           'load-more' => 'Lataa lisää',
           'add-option' => 'Lisää vaihtoehto',
           'reset' => 'Palauta',
           'apply-filters' => 'Apply filters',
           'search-activity-items' => 'Search Activity Items',
           'create-new-activity-item' => 'Create new Activity Item',
           'login-or-register' => 'Login/Register',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Syötä avainsana tai otsikko',
           'option-text' => 'Valintateksti',
           'embedded-content' => 'Syötä sulautetti HTML-koodi tähän.',
           'search-text' => 'Syötä etsittävä teksti',
           'read-more' => 'Syötä URL jossa löytyy lisää tietoja aiheesta.',
           'name-or-email' => 'Name or email',
           'access-code' => 'Code or text to access question without positioning restrictions',
           'datetime' => 'Date or Date and Time',
           'question-or-information' => 'Please write Question or Information, depending on chosen Question Type',
       ],
       'options' => [
           'any' => 'Joku',
       ],
       'addons' => [
           'hours' => 'hours',
           'awarded' => 'awarded',
       ],
       'tooltips' => [
           'remove-image' => 'Check to remove an existing image',
       ],
       'warnings' => [
           'readd-pictures' => 'If you had added any pictures, you have to add them again. Sorry.',
       ],
   ],
   'actions' => [
       'create' => 'Luo',
       'edit' => 'Muokkaa',
       'delete' => 'Poista',
       'play' => 'Pelaa',
       'send-to-backpack' => 'Lähetä reppuun',
       'download-baked-badge' => 'Hae arvomerkkikuva',
       'assertion-open' => 'Aukaise arvomerkkilinkki',
       'discount-voucher-spend' => 'Spend Discount Voucher',
       'get-qr-code' => 'Get QR Code',
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
   'difficulty-level' => [
     'easy' => 'Easy',
     'medium' => 'Medium',
     'hard' => 'Hard',
   ],
   'cookie-consent' => [
       'text' => 'This website uses cookies to ensure you get the best possible online experience. By continuing to use our website, you agree to the use of cookies.',
       'button-agree' => 'Agree',
   ],
];
