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
       'collecting-cards' => 'Samlarkort',
       'treasure-hunt' => 'Skattjakt',
   ],
   'activity-status' => [
       'complete' => 'Hela aktiviteten',
       'ongoing' => 'Pågående aktivitet',
   ],
   'language' => 'Språk',
   'languages' => [
       'en' => 'English',
       'et' => 'Eesti keel',
       'ru' => 'По-русски',
       'fi' => 'Suomi',
       'sv' => 'Svenska',
   ],
   'zoos' => [
     'skansen' => 'Skansen',
     'korkeasaari' => 'Högholmen',
     'tallinn' => 'Tallinn Zoo',
   ],
   'question-types' => [
     'one-correct-answer' => 'Endast ett korrekt svar',
     'multiple-correct-answers' => 'Flera korrekta svar',
     'freeform-answer' => 'Fritextsvar',
     'match-pairs' => 'Sök par',
     'embedded-content' => 'Inkapslade media',
     'photo' => 'Foto',
     'information' => 'Information',
   ],
   'forms' => [
       'labels' => [
           'activity-type' => 'Aktivitetstyp',
           'title' => 'Titel',
           'description' => 'Beskrivning',
           'difficulty-level' => 'Svårighetsnivå',
           'playing-time' => 'Speltid',
           'contact-information' => 'Kontaktinformation',
           'featured-image' => 'Rubrikbild',
           'zoo' => 'Zoo',
           'question-type' => 'Frågetyp',
           'location' => 'Plats',
           'activity-items' => 'Uppgift',
           'proximity' => 'Närhet',
           'search-text' => 'Sök text',
           'read-more' => 'Läs mera',
           'image' => 'Bild',
       ],
       'help' => [
           'playing-time' => 'Aktivitetstid i minuter',
           'image' => 'En bild i JPEG- eller PNG-format.  Den uppladdade bilden kommer att skalas om till 800×800 pixlar.',
           'map' => 'Välj rätt djurpark och släpa markören till önskad plats.',
           'question-types' => [
               'information' => 'Beskrivningstexten kommer att visas som information för platsen.',
               'freeform-answer' => 'Inmatningsrutan visas för spelaren.',
               'embedded-content' => 'Inbäddad HTML-kod i textrutan visas för spelaren.',
               'photo' => 'Spelaren kan ladda upp en bild som sitt svar.',
           ],
       ],
       'buttons' => [
           'create' => 'Skapa',
           'save' => 'Spara',
           'cancel' => 'Avbryt',
           'close' => 'Stäng',
           'submit' => 'Skicka',
           'search' => 'Sök',
           'add-activity-items' => 'Lägg till en uppgift.',
           'load-more' => 'Hämta mera.',
           'add-option' => 'Lägg till ett alternativ.',
           'reset' => 'Återställ',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Skriv ett nyckelord eller en rubrik.',
           'option-text' => 'Valtext',
           'embedded-content' => 'Lägg in inbäddad HTML-kod här.',
           'search-text' => 'Skriv in texten som ska sökas',
           'read-more' => 'Lägg in en URL med mer information om frågan.',
       ],
       'options' => [
           'any' => 'Någon',
       ]
   ],
   'actions' => [
       'create' => 'Skapa',
       'edit' => 'Redigera',
       'delete' => 'Ta bort',
       'play' => 'Spela',
       'send-to-backpack' => 'Lägg i ryggsäcken',
       'download-baked-badge' => 'Hämta ditt märke',
       'assertion-open' => 'URL till märken',
   ],
   'minutes' => 'minuter',
   'confirmations' => [
       'delete' => 'Ta bort uppgift.  Är du säker?',
   ],
   'date-time' => [
       'formats' => [
           'short' => 'F d, Y',
           'medium' => 'F d, Y H:i',
           'long' => 'F d, Y, H:i:s',
       ],
       'created-at' => 'Skapad ',
       'updated-at' => 'Uppdaterad ',
   ],
   'roles' => [
       'admin' => 'Administratör',
       'zooAdmin' => 'Administratör',
       'zooMember' => 'Medlem',
   ],
   'difficulty-level' => [
     'easy' => 'Easy',
     'medium' => 'Medium',
     'hard' => 'Hard',
   ],
];
