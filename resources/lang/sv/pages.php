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
                'heading' => 'Vad är SmartZoos?',
                'content' => 'SmartZoos är en speltjänst för platsberoende spel, där uppgifterna leder dig genom omgivningen och du kanske lär dig ett eller annat.',
            ],
            'schools' => [
                'heading' => 'SmartZoos för skolor',
                'content' => 'Flytta klassrummet utomhus!<br>SmartZoos är ett modernt sätt att kombinera skola med pedagogisk lek.  Med ett skaparkonto kan du skapa aktiviteter för dig och andra SmartZoos-användare.',
            ],
        ],
        'choose-location' => 'Välj plats',
        'btn' => [
            'play-smart-zoos' => 'Spela',
        ],
        'project-information' => 'SmartZoos knyter samman djurparkerna i Östersjöområdet som en gemensam turistattraktion genom gemensamma pedagogiska mobilspel.',
    ],
    'activities' => [
        'index' => [
            'heading' => 'Aktiviteter',
            'none-found' => 'Inga aktiviteter hittade.',
        ],
        'create-or-edit' => [
            'keywords' => 'Nyckelord',
            'items-found' => 'hittade uppgifter.',
            'tooltips' => [
                'proximity-check' => 'Avgör om avståndsbedömning används',
            ],
            'help' => [
                'proximity' => 'Ställ endast om närhetsradien om standardinställningen :default m inte fungerar. Radien bör vara 25–100 m. Om du klickar ur rutan till höger kommer avståndsbedömning inte användas alls.',
            ],
        ],
    ],
    'activity-items' => [
        'index' => [
          'heading' => 'Uppgifter',
          'none-found' => 'Inga uppgifter hittade.',
        ],
        'create-or-edit' => [
            'set-current-position' => 'Ställ in nuvarande position.',
            'geolocation-error' => 'Fel: Positionen kan ej bestämmas.',
        ],
    ],
    'discount-vouchers' => [
        'index' => [
            'heading' => 'Rabattkuponger',
            'none-found' => 'Inga rabattkuponger kunde hittas.',
        ],
    ],
    'manage' => [
        'users' => [
            'index' => [
                'heading' => 'Hantera användare',
                'none-found' => 'Inga användare funna',
                'accounts' => 'Konton',
                'roles' => 'Roller',
                'manage-roles' => 'Hantera roller',
                'remove-role' => 'Ta bort roll',
                'block-account' => 'Block',
                'unblock-account' => 'Unblock',
                'confirmations' => [
                    'role' => 'Ta bort roll.  Är du säker?',
                ],
                'modal' => [
                    'title' => 'Hantera roller',
                ],
            ]
        ],
        'statistics' => [
            'heading' => 'Statistik',
            'users' => 'Användare',
            'activities' => 'Aktiviteter',
            'activity-items' => 'Uppgifter',
            'games' => 'Spel',
            'discount-vouchers' => 'Rabattkuponger',
            'blocked-users' => 'Blocked',
            'unverified-users' => 'Unverified',
            'captions' => [
                'activities-by-zoo' => 'Sorterade per djurpark',
                'activities-by-language' => 'Sorterade per språk',
                'activity-items-by-zoo' => 'Uppgifter sorterade per djurpark',
                'activity-items-by-question-type' => 'Uppgifter sorterade per frågetyp',
                'activity-items-by-language' => 'Uppgifter sorterade per språk',
                'games-by-status' => 'Spel sorterade per tillstånd.',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Totalt antal rabattkuponger',
                'discount-vouchers-redeemed' => 'Inlösta',
            ],
        ],
    ],
    'play' => [
        'game' => [
            'loading' => 'Spelet laddas…',
            'its-you' => 'Här är du',
            'info' => 'Spelinformation',
            'position-tracking' => 'Slå av/på positionsbestämning',
            'exit' => 'Avsluta spelet',
            'exit-confirmation' => 'Avsluta spelet.  Är du säker?  Endast inloggade användare kan fortsätta ett avslutat spel',
            'change-map-type' => 'Byt karttyp',
            'textual-answer-placeholder' => 'Svarstext…',
            'image-format-hint' => 'Endast JPEG- eller PNG-bilder tillåtna.',
            'apply-item-bounds' => 'Visa alla uppgifter på kartan.',
            'results-heading' => 'Dina resultat',
            'number-of-questions' => 'Antal frågor',
            'gps-error' => 'Ingen GPS-signal.',
            'go' => 'Starta!',
            'back' => 'Tillbaka',
            'next' => 'Nästa',
            'got-it' => 'Jag förstår!',
            'read-more-about' => 'Läs mer om…',
            'tips-text' => 'Några tips innan du börjar',
            'access-code-placeholder' => 'Mata in koden eller texten för att komma förbi platsbindningen.',
            'not-logged-in' => 'Ej inloggad!',
            'complete' => 'Färdig!',
            'icons' => [
                'help' => 'Varje ikons färg visar uppgiftens tillstånd.',
                'active' => 'Obesvarad',
                'inactive' => 'Utom räckhåll',
                'correct' => 'Rätt svar',
                'incorrect' => 'Fel svar',
            ],
            'items' => [
                'gameplay_instructions' => [
                    'title' => 'Hur man spelar',
                    'description' => 'Undersök platsen, hitta och besvara alla frågor.',
                ],
                'look_closely' => [
                    'title' => 'Se dig om',
                    'description' => 'Leta noga i omgivningarna efter ledtrådar. Man vet aldrig var man kan hitta svaren!',
                ],
                'look_out' => [
                    'title' => 'Se upp!',
                    'description' => 'Se dig för så att du inte skadar dig eller andra.',
                ],
                'do_not_disturb' => [
                    'title' => 'Skrik inte',
                    'description' => 'Det är kul att vinna, men skräm inte djuren.',
                ],
                'help_others' => [
                    'title' => 'Hjälp varandra',
                    'description' => 'Hjälp dina vänner och ha kul tillsammans!',
                ],
            ],
            'vouchers' => [
                'heading' => 'You have received a voucher!',
                'details' => 'For details go to',
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Kontrollpanel',
        'heading' => 'Välkommen, :name!',
        'none-found' => 'Inga spel eller aktiviteter hittade.',
        'games-and-activities' => 'Spel och aktiviteter',
        'finished' => 'Avslutad :date',
        'started' => 'Påbörjad :date',
        'btn' => [
            'view-results' => 'Se resultat',
            'continue' => 'Fortsätt',
        ],
    ],
    'activity-results-index' => [
        'title' => 'Aktiviteter',
        'heading' => 'Aktiviteternas resultat',
        'zoos' => 'Aktiviteterna nedan hör till följande djurparker',
    ],
    'activity-results' => [
        'heading' => '<strong>:title</strong>, resultat',
        'btn' => [
            'download-player-positions' => 'Ladda ner spelarpositioner',
        ],
    ],
    'profile' => [
        'title' => 'Profil',
        'heading' => ':name s profil',
        'labels' => [
            'badges-earned' => 'Vunna märken',
            'discount-vouchers-earned' => 'Vunna rabattkuponger',
            'valid-until' => 'Gäller till',
        ],
        'confirmations' => [
            'discount-voucher-spend' => 'Lösa in rabattkupong.  Är du säker?',
        ],
        'discount-vouchers' => [
            'information' => 'Vouchers are rewarded for completing Activities. Show the voucher to the staff to redeem. All vouchers are valid for a certain period of time and could only be redeemed within a certain time frame.',
            'how-to-redeem' => 'Please let the staff member press the button and confirm the process. This can not be undone.',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Lämna lösenordfältet tomt om du inte vill ändra det.',
        ]
    ],
    'badges' => [
        'introduction' => [
            'general' => 'Genom att klara av vissa uppgifter i SmartZoos, får du belöningsmärken.',
            'authenticated' => 'Märkena du samlat kan du se i din  <a href=":profileUrl">profil</a>.',
            'guest' => 'För att kunna samla märken måste du <a href=":loginUrl">logga in</a>.',
        ],
    ],

];
