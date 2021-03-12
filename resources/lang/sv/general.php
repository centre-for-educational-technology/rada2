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
           'game-story-and-rules' => 'Game story and rules',
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
           'access-code-clues' => 'Ledtråd till åtkomstkoden',
           'amount' => 'Mängd',
           'hide-incognito' => 'Göm namnlösa',
           'hide-incomplete' => 'Göm ofullständiga',
           'from' => 'Från',
           'until' => 'Till',
           'question-or-information' => 'Fråga/Information',
           'promoted' => 'Flytta upp, visa en specialikon och lägg överst i listor',
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
           'access-code-clues' => 'Ledtrådar till vad/var åtkomstkoden är',
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
           'remove-selected-image' => 'Ta bort den valda bilden.',
           'mark-option-as-correct' => 'Kryssa i för att godkänna valet.',
       ],
       'warnings' => [
           'readd-pictures' => 'Om du hade lagt till bilder måste du tyvärr göra om det igen.',
       ],
       'alerts' => [
           'image-loading-text' => 'Läser in ...',
           'form-submit-loading-text' => 'Läser in ...'
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
       'discount-voucher-spend' => 'Använda rabattkupong',
       'reveal-discount' => 'Visa rabatt',
   ],
   'minutes' => 'minuter',
   'confirmations' => [
       'delete' => 'Ta bort uppgift.  Är du säker?',
       'play' => 'Du är inte inloggad!  Ditt spel kommer inte att sparas och du kan inte hämta ut några priser.',
       'block-account' => 'Blockera valt konto.  Är du säker?',
       'unblock-account' => 'Avblockera valt konto.  Är du säker?',
       'delete-account' => 'Ta bort valt konto.  Detta kan inte ångras och kommer att ta bort allt material skapat av denna användare.  Är du säker?',
       'unload-protection' => 'Du kan ha osparade ändringar.  Vill du ändå lämna denna sida?',
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
       'text' => 'Denna webbplats använder kakor för att du ska få en så bra upplevelse som möjligt. <a href=":policy" target="_blank">Genom att fortsätta godkänder du användandet av kakor.</a>',
       'button-agree' => 'Jag godkänner',
   ],
   'system-requirements' => 'Systemkrav: iOS (version 10) eller Android 7. 3G-förbindelse till Internet och fungerande GPS.',
   'messages' => [
       'warnings' => [
           'account-blocked' => 'Detta konto har stängts av.  Var vänlig kontakta administratören för mer information.',
           'account-email-not-verified' => 'Detta konto har ännu inte bekräftats.  Följ instruktionerna du fått i din e-post.',
       ],
       'successes' => [
           'account-email-verification-sent' => 'Ditt konto har skapats.  Du har fått instruktioner i din e-post för hur du ska bekräfta kontot.',
           'account-email-verified' => 'Ditt konto har bekräftats.  Du kan nu logga in.',
       ],
   ],
];
