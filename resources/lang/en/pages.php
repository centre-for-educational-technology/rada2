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
            'heading' => 'What is SmartZoos?',
            'content' => 'SmartZoos integrates the zoos of the CB region to form a joint tourist attraction through developing, implementing and joint marketing of a cross-border service package of creative adventure learning with mobile devices.',
        ],
        'choose-location' => 'Choose location',
        'btn' => [
            'play-smart-zoos' => 'Play SmartZoos',
        ],
    ],
    'activities' => [
        'index' => [
            'heading' => 'Activities',
            'none-found' => 'No Activities could be found.',
        ],
        'create-or-edit' => [
            'keywords' => 'Keywords',
            'items-found' => 'items found',
            'tooltips' => [
                'proximity-check' => 'Determines if proximity check is applied',
            ],
            'help' => [
                'proximity' => 'Only set proximity radius in meters if default value of :default is not suitable. We recommend setting it to a value between 25 to 100 meters. If you uncheck the checkbox situated to the right of the field, then the game will not check proximity at all.',
            ],
        ],
    ],
    'activity-items' => [
        'index' => [
          'heading' => 'Activity Items',
          'none-found' => 'No Activity Items could be found.',
        ],
        'create-or-edit' => [
            'set-current-position' => 'Set current position',
            'geolocation-error' => 'Error: Geolocation could not be determined',
        ],
    ],
    'discount-vouchers' => [
        'index' => [
            'heading' => 'Discount Vouchers',
            'none-found' => 'No Discount Vouchers could be found.',
        ],
    ],
    'manage' => [
        'users' => [
            'index' => [
                'heading' => 'Manage Users',
                'none-found' => 'No User could be found',
                'accounts' => 'Accounts',
                'roles' => 'Roles',
                'manage-roles' => 'Manage roles',
                'remove-role' => 'Remove role',
                'confirmations' => [
                    'role' => 'Are you sure you want to remove selected role?',
                ],
                'modal' => [
                    'title' => 'Manage user roles',
                ],
            ]
        ],
        'statistics' => [
            'heading' => 'Statistics',
            'users' => 'Users',
            'activities' => 'Activities',
            'activity-items' => 'Activity Items',
            'games' => 'Games',
            'discount-vouchers' => 'Vouchers',
            'captions' => [
                'activities-by-zoo' => 'Activities by Zoo',
                'activities-by-language' => 'Activities by Language',
                'activity-items-by-zoo' => 'Activity Items by Zoo',
                'activity-items-by-question-type' => 'Activity Items by Question Type',
                'activity-items-by-language' => 'Activity Items by Language',
                'games-by-status' => 'Games by Status',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Total vouchers',
                'discount-vouchers-redeemed' => 'Redeemed',
            ],
        ],
    ],
    'play' => [
        'game' => [
            'loading' => 'Game Loading ...',
            'its-you' => 'It\'s you',
            'info' => 'Game information',
            'position-tracking' => 'Enable or disable position tracking',
            'exit' => 'Exit current game',
            'exit-confirmation' => 'Are you sure you want to exit the game? Only authenticated users would be able to continue later.',
            'change-map-type' => 'Change map type',
            'textual-answer-placeholder' => 'Answer text...',
            'image-format-hint' => 'Please use only PNG or JPG/JPEG images.',
            'apply-item-bounds' => 'Show all available Activity Item points on the map',
            'results-heading' => 'These are your results',
            'number-of-questions' => 'No. of Questions',
            'gps-error' => 'GPS signal not found.',
            'go' => 'GO!',
            'back' => 'Back',
            'next' => 'Next',
            'got-it' => 'Got it!',
            'read-more-about' => 'Read more about...',
            'tips-text' => 'Some tips before you start:',
            'access-code-placeholder' => 'Please enter the code or text to override positional restriction',
            'icons' => [
                'help' => 'Each icon has a colour code that indicates the state of a question.',
                'active' => 'Unanswered',
                'inactive' => 'Out of reach',
                'correct' => 'Correct',
                'incorrect' => 'Incorrect answer',
            ],
            'items' => [
                'look_closely' => [
                    'title' => 'Look around',
                    'description' => 'Look closely at your surroundings for clues. You never know where you\'ll find answers!',
                ],
                'look_out' => [
                    'title' => 'Look out!',
                    'description' => 'Be mindful of where you\'re going so you don\'t hurt yourself or others',
                ],
                'do_not_disturb' => [
                    'title' => 'Don\'t be too loud',
                    'description' => 'Victory is nice, but don\'t scare the animals',
                ],
                'help_others' => [
                    'title' => 'Help each other',
                    'description' => 'Help your friends and have fun together!',
                ],
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'heading' => 'Welcome, :name!',
        'none-found' => 'No Games or Activities found',
        'games-and-activities' => 'Games & activities',
        'finished' => 'Finished :date',
        'started' => 'Started :date',
        'btn' => [
            'view-results' => 'View results',
            'continue' => 'Continue',
        ],
    ],
    'activity-results-index' => [
        'title' => 'Activities',
        'heading' => 'Results of Activities',
        'zoos' => 'Displayed activities belong to these Zoos',
    ],
    'activity-results' => [
        'heading' => 'Results of <strong>:title</strong>',
        'btn' => [
            'download-player-positions' => 'Download player positions',
        ],
    ],
    'profile' => [
        'title' => 'Profile',
        'heading' => 'Profile of :name',
        'labels' => [
            'badges-earned' => 'Badges Earned',
            'discount-vouchers-earned' => 'Discount Vouchers Earned',
            'valid-until' => 'Valid until',
        ],
        'confirmations' => [
            'discount-voucher-spend' => 'Are you sure you want to spend this Discount Voucher?',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Please leave password field empty, unless you want to have it changed.',
        ]
    ],

];
