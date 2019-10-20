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
                'heading' => 'What is RADA?',
                'content' => 'RADA is a location-based game service, where the tasks will guide you throughout your environment and teach you a thing or two.',
            ],
            'schools' => [
                'heading' => 'RADA for Schools',
                'content' => 'Move the classroom to the great outdoors!<br>RADA is a modern way to combine school with gamified fun. With a Creator account, you can create fun and games to be used by you and other RADA users.',
            ],
        ],
        'choose-location' => 'Choose location',
        'btn' => [
            'play-smart-zoos' => 'Play RADA',
        ],
        'project-information' => 'RADA integrates the zoos of the CB region to form a joint tourist attraction through developing, implementing and joint marketing of a cross-border service package of creative adventure learning with mobile devices.',
    ],
    'activities' => [
        'index' => [
            'heading' => 'Games',
            'none-found' => 'No Games could be found.',
            'promoted' => 'Open Games',
            'my_games' => 'My Games',
            'templates' => 'Templates'
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
          'heading' => 'Tasks',
          'none-found' => 'No Tasks could be found.',
        ],
        'create-or-edit' => [
            'set-current-position' => 'Set current position',
            'geolocation-error' => 'Error: Geolocation could not be determined',
            'tooltips' => [
                'answering-time' => 'Enforce answering time'
            ],
            'help' => [
                'answering_time' => 'Answering time format: 1h 1m 55s'
            ],
        ]
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
                'block-account' => 'Block',
                'unblock-account' => 'Unblock',
                'delete-account' => 'Delete',
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
            'activities' => 'Games',
            'activity-items' => 'Tasks',
            'games' => 'Games',
            'discount-vouchers' => 'Vouchers',
            'blocked-users' => 'Blocked',
            'unverified-users' => 'Unverified',
            'download-csv' => 'Export playing data',
            'captions' => [
                'activities-by-zoo' => 'Games by Zoo',
                'activities-by-language' => 'Games by Language',
                'activity-items-by-zoo' => 'Tasks by Zoo',
                'activity-items-by-question-type' => 'Tasks by Question Type',
                'activity-items-by-language' => 'Tasks by Language',
                'games-by-status' => 'Games by Status',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Total vouchers',
                'discount-vouchers-redeemed' => 'Redeemed',
            ],
        ],
        'game' => [
            'exercises-and-points' => 'The game contains: :exercises Exercises / :points Points',
            'player-summary' => [
                'title' => 'Player summary',
                'place' => 'Place',
                'player' => 'Player',
                'points' => 'Points',
                'time' => 'Time spent',
                'nr-exercises' => 'Number of exercises',
                'answered' => 'Answered',
                'graded' => 'Graded',
                'not-graded' => 'Not graded'
            ],
            'exercise-summary' => [
                'title' => 'Tasks summary',
                'exercise' => 'Task',
                'answered' => 'Answered',
                'graded' => 'Graded',
                'not-graded' => 'Not graded',
                'total' => 'Total',
                'average' => 'Average',
                'min' => 'Min',
                'max' => 'Max',
                'player' => 'Player status',
                'points' => 'Points',
                'time-spent' => 'Time spent'
            ],
            'tasks' => [
                'title' => 'Tasks',
                'points' => 'Points',
                'answer-from' => 'Answer from',
                'graded' => 'Graded',
                'not-graded' => 'Not graded',
                'select-all-players' => 'Select all players',
                'select-all-tasks' => 'Select all tasks',
                'filter' => 'Filter'
            ]
        ]
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
            'apply-item-bounds' => 'Show all available Task points on the map',
            'results-heading' => 'These are your results',
            'stopped-heading' => 'Game has been stopped',
            'task-is-pending-an-evaluation' => 'Task is pending an evaluation',
            'number-of-questions' => 'No. of Questions',
            'gps-error' => 'GPS signal not found.',
            'go' => 'GO!',
            'back' => 'Back',
            'next' => 'Next',
            'got-it' => 'Got it!',
            'read-more-about' => 'Read more about...',
            'tips-text' => 'Some tips before you start',
            'access-code-placeholder' => 'Please enter the code or text to override positional restriction',
            'not-logged-in' => 'Not logged in',
            'complete' => 'Complete!',
            'remaining_time' => 'Remaining time',
            'flash-exercises-list-modal-title' => 'Flash exercises',
            'flash-exercise-has-been-deactivated' => 'Flash exercise has been deactivated. It is not possible to submit an answer anymore.',
            'icons' => [
                'help' => 'Each icon has a colour code that indicates the state of a question.',
                'active' => 'Unanswered',
                'inactive' => 'Out of reach',
                'correct' => 'Correct',
                'incorrect' => 'Incorrect answer',
            ],
            'items' => [
                'gameplay_instructions' => [
                    'title' => 'How to play',
                    'description' => 'Investigate the location, find and complete all the tasks!',
                ],
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
                'answering_time' => [
                    'description' => 'There is a time limit on this question. Click the "Start" button to see the question.',
                    'start_timer' => 'Start',
                    'time_is_up' => 'The time that was meant to answer this question is over.'
                ]
            ],
            'vouchers' => [
                'heading' => 'You have received a voucher!',
                'details' => 'For details go to',
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'heading' => 'Welcome, :name!',
        'none-found' => 'No Games found',
        'games-and-activities' => 'Games',
        'finished' => 'Finished :date',
        'started' => 'Started :date',
        'btn' => [
            'view-results' => 'View results',
            'continue' => 'Continue',
        ],
    ],
    'activity-results-index' => [
        'title' => 'Games',
        'heading' => 'Results of Games',
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
        'discount-vouchers' => [
            'information' => 'Vouchers are rewarded for completing Games. Show the voucher to the staff to redeem. All vouchers are valid for a certain period of time and could only be redeemed within a certain time frame.',
            'how-to-redeem' => 'Please let the staff member press the button and confirm the process. This can not be undone.',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Please leave password field empty, unless you want to have it changed.',
        ]
    ],
    'badges' => [
        'introduction' => [
            'general' => 'By accomplishing certain tasks within RADA, you will be rewarded with badges.',
            'authenticated' => 'The badges you have collected can be seen on your <a href=":profileUrl">Profile</a>.',
            'guest' => 'In order to collect badges, you must be <a href=":loginUrl">logged in</a>.',
        ],
    ],
    'grading' => [
        'index' => [
            'heading' => 'Grading',
            'none-found' => 'No gradable items found',
            'graded' => 'Graded',
            'switch-label' => 'Show already graded questions',
            'grading-info' => 'You can enter value between 0 and',
            'success' => 'Successfully saved',
            'go-back-to-list' => 'Go back to list',
            'submit-grade' => 'Save',
            'heading-answer' => 'Answer',
            'heading-grade' => 'Grade',
            'heading-question-information' => 'Question/Information',
            'heading-previous-grades' => 'Previous grades',
            'details-btn' => 'Details',
            'question-type' => 'Question Type',
            'answer_table' => [
                'option' => 'Option',
                'correct' => 'Correct answer',
                'answer' => 'Answer',
                'points' => 'Points',
                'image' => 'Image'
            ]
        ]
    ]

];
