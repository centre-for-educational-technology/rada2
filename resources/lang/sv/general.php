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
       'complete' => 'Hela aktiviteten',
       'ongoing' => 'Pågående aktivitet',
   ],
   'discount-voucher-status' => [
       'inactive' => 'Inaktiv',
       'active' => 'Aktiv',
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
           'duration' => 'Tidsåtgång',
           'status' => 'Status',
           'discount-voucher' => 'Rabattkupong',
           'access-code' => 'Åtkomstkod',
           'access-code-clues' => 'Access Code Clues',
           'amount' => 'Mängd',
           'hide-incognito' => 'Göm namnlösa',
           'hide-incomplete' => 'Göm ofullständiga',
           'from' => 'Från',
           'until' => 'Till',
           'question-or-information' => 'Fråga/Information',
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
           'load-more' => 'Hämta mera.',
           'add-option' => 'Lägg till ett alternativ.',
           'reset' => 'Återställ',
           'apply-filters' => 'Använd filter',
           'search-activity-items' => 'Sök uppgifter',
           'create-new-activity-item' => 'Skapa ny uppgift',
           'login-or-register' => 'Logga in/Registrera dig',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Skriv ett nyckelord eller en rubrik.',
           'option-text' => 'Valtext',
           'embedded-content' => 'Lägg in inbäddad HTML-kod här.',
           'search-text' => 'Skriv in texten som ska sökas',
           'read-more' => 'Lägg in en URL med mer information om frågan.',
           'name-or-email' => 'Namn eller epostadress',
           'access-code' => 'Kod eller text för att komma åt frågan oavsett position',
           'access-code-clues' => 'Clues to what/where the Access Code is',
           'datetime' => 'Datum eller datum och tid',
           'question-or-information' => 'Skriv en fråga eller information, beroende på uppgiftstypen.',
       ],
       'options' => [
           'any' => 'Någon',
       ],
       'addons' => [
           'hours' => 'timmar',
           'awarded' => 'utdelad',
       ],
       'tooltips' => [
           'remove-image' => 'Kryssa i för att ta bort en bild',
       ],
       'warnings' => [
           'readd-pictures' => 'If you had added any pictures, you have to add them again. Sorry.',
       ],
   ],
   'actions' => [
       'create' => 'Skapa',
       'edit' => 'Redigera',
       'delete' => 'Ta bort',
       'play' => 'Spela',
       'send-to-backpack' => 'Lägg i ryggsäcken',
       'download-baked-badge' => 'Hämta ditt märke',
       'assertion-open' => 'URL till märken',
       'discount-voucher-spend' => 'Använda rabattkupong',
       'get-qr-code' => 'Hämta QR-kod',
   ],
   'minutes' => 'minuter',
   'confirmations' => [
       'delete' => 'Ta bort uppgift.  Är du säker?',
       'play' => 'You are not logged in! - Progress will not be saved and any rewards cannot be claimed.',
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
     'easy' => 'Lätt',
     'medium' => 'Medium',
     'hard' => 'Svår',
   ],
   'cookie-consent' => [
       'text' => 'Denna webbplats använder kakor för att du ska få en så bra upplevelse som möjligt.  Genom att fortsätta godkänder du användandet av kakor.',
       'button-agree' => 'Jag godkänner',
   ],
];
