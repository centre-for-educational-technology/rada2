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
       'inactive' => 'Toimiton',
       'active' => 'Toimiva',
   ],
   'language' => 'Kieli',
   'languages' => [
       'en' => 'English',
       'et' => 'Eesti keel',
       'ru' => 'По-русски',
       'fi' => 'Suomi',
       'sv' => 'Svenska',
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
           'game-story-and-rules' => 'Game story and rules',
           'difficulty-level' => 'Vaikeusaste',
           'playing-time' => 'Peliaika',
           'contact-information' => 'Yhteystiedot',
           'featured-image' => 'Otsikkokuva',
           'question-type' => 'Kysymyslaji',
           'location' => 'Paikka',
           'activity-items' => 'Tehtävä',
           'proximity' => 'Läheisyys',
           'search-text' => 'Etsi tekstiä',
           'read-more' => 'Lue lisää',
           'image' => 'Kuva',
           'duration' => 'Kesto',
           'status' => 'Tila',
           'discount-voucher' => 'Alennuskuponki',
           'access-code' => 'Avauskoodi',
           'access-code-clues' => 'Avauskoodin vihje',
           'amount' => 'Määrä',
           'hide-incognito' => 'Piilota nimetön',
           'hide-incomplete' => 'Piilota keskeneräinen',
           'from' => 'Alku',
           'until' => 'Loppu',
           'question-or-information' => 'Kysymys/informaatio',
           'promoted' => 'Mainostus, näytä erikoiskuvike ja siirrä listan päähän',
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
           'apply-filters' => 'Suodata',
           'search-activity-items' => 'Etsi tehtäviä',
           'create-new-activity-item' => 'Luo uusi tehtävä',
           'login-or-register' => 'Kirjaudu sisään/rekisteröydy',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Syötä avainsana tai otsikko',
           'option-text' => 'Valintateksti',
           'embedded-content' => 'Syötä sulautetti HTML-koodi tähän.',
           'search-text' => 'Syötä etsittävä teksti',
           'read-more' => 'Syötä URL jossa löytyy lisää tietoja aiheesta.',
           'name-or-email' => 'Nimi tai sähköpostiosoite',
           'access-code' => 'Koodi tai salasana nähdäkseen kysymyksen ilman paikallistamista',
           'access-code-clues' => 'Vihje missä/mitä avauskoodi on',
           'datetime' => 'Päivämäärä tai päivämäärä ja aika',
           'question-or-information' => 'Kirjoita kysymys tai tieto, kysymystyypistä riippuen',
       ],
       'options' => [
           'any' => 'Joku',
       ],
       'addons' => [
           'hours' => 'tuntia',
           'awarded' => 'myönnetty',
       ],
       'tooltips' => [
           'remove-image' => 'Rastita poistaaksen kuva.',
           'remove-selected-image' => 'Poista valittu kuva.',
           'mark-option-as-correct' => 'Rastita osoittaksen valinnan oikeaksi.',
       ],
       'warnings' => [
           'readd-pictures' => 'Jos olit lisännyt kuvan, sinun on valitettavasti pakko tehdä uudestaan.',
       ],
       'alerts' => [
           'image-loading-text' => 'Ladataan ...',
           'form-submit-loading-text' => 'Ladataan ...'
       ]
   ],
   'actions' => [
       'create' => 'Luo',
       'edit' => 'Muokkaa',
       'delete' => 'Poista',
       'play' => 'Pelaa',
       'discount-voucher-spend' => 'Käytä alennuskuponkia',
       'reveal-discount' => 'Näytä alennus',
   ],
   'minutes' => 'minuuttia',
   'confirmations' => [
       'delete' => 'Haluatko tosiaan poistaa tämän tehtävän?',
       'play' => 'Et ole kirjautunut sisään!  Et voi säästää peliäsi etkä voi saada palkintoja.',
       'block-account' => 'Haluatko estää valitun käyttäjän?',
       'unblock-account' => 'Haluatko poistaa eston valitusta käyttäjästä?',
       'delete-account' => 'Haluatko poistaa valitun käyttäjän?  Tätä ei voi peruuttaa sekä poistaa myös kaiken käyttäjän luoma sisällys.',
       'unload-protection' => 'Sinulla saattaa olla tallentamattomia muutoksia. Haluatko kuitenkin jättää tämän  sivun?',
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
   ],
   'difficulty-level' => [
     'easy' => 'Helppo',
     'medium' => 'Keskenvertainen',
     'hard' => 'Vaikea',
   ],
   'cookie-consent' => [
       'text' => 'Tämä sivusto käyttää evästeitä antaaksen sinulle parhaan mahdollisimman elämyksen,.  Jatkaen käyttää sivustoamme  <a href=":policy" target="_blank">hyväksyt evästeiden käyttöä</a>.',
       'button-agree' => 'Hyväksyn',
   ],
   'system-requirements' => 'Laitevaatimukset: käyttöjärjestelmä iOS (versio 10) tai Android 7. Vähintään 3G Internetyhteys sekä toimiva GPS vaaditaan.',
   'messages' => [
       'warnings' => [
           'account-blocked' => 'Tämä tili on pidätetty. Ota yhteys ylläpitäjälle lisätietoja varten.',
           'account-email-not-verified' => 'Tämä tili ei ole todennettu vielä.  Todennustiedot ovat lähetetty sinulle sähköpostitse.',
       ],
       'successes' => [
           'account-email-verification-sent' => 'Tilisi on luotu.  Seuraa ohjeet sähköpostissasi todentaaksen tilisi.',
           'account-email-verified' => 'Tilisi on todennettu.  Voit nyt kirjautua sisään.',
       ],
   ],
];
