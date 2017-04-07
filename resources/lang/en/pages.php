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
                'proximity' => 'Only set proximity radius in meters if defalult value of :default is not suitable. We recommend setting it to a value between 25 to 100 meters. If you uncheck the checkbox situated to the right of the field, then the game will not check proximity at all.',
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
    ],
    'play' => [
        'game' => [
            'loading' => 'Game Loading ...',
            'its-you' => 'It\'s you',
            'info' => 'Game information',
            'position-tracking' => 'Enable or disable position tracking',
            'exit' => 'Exit current game',
            'exit-confirmation' => 'Are you sure you want to exit the game? Only authenticated users would be able to continue later.',
            'textual-answer-placeholder' => 'Answer text...',
            'image-format-hint' => 'Please use only PNG or JPG/JPEG images.',
        ],
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'heading' => 'Welcome, :name!',
        'none-found' => 'No Games or Activities found',
        'games-and-activities' => 'Games & activities',
        'finished' => 'Finished :date',
        'started' => 'Started :date',
        'market-and-card-trading' => 'Market and card trading',
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
        'heading' => 'Results of :title',

    ],
    'profile' => [
        'title' => 'Profile',
        'heading' => 'Profile of :name',
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Please leave password field empty, unless you want to have it changed.',
        ]
    ],

];
