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
                'heading' => 'Приложение "Умные зоопарки" (SmartZoos), что это такое?',
                'content' => 'Приложение Умные зоопарки - это игровой сервис, основанный на местоположении, с помощью которого вы сможете больше узнать о животных и научиться вести за ними наблюдение.',
            ],
            'schools' => [
           'heading' => 'Приложение Умные зоопарки  для общеобразовательных учебных заведений',
                'content' => 'Переместите класс за пределы школы!<br>Приложение Умные зоопарки - это современный способ обучаться играя. В роли Разработчика Вы сможете сможете создавать занимательные Учебные тропы, или Игры, в которые будете играть сами или другие пользователи приложения Умные зоопарки.',
            ],
        ],
        'choose-location' => 'Выберите расположение',
        'btn' => [
            'play-smart-zoos' => 'Играть в Умные зоопарки',
        ],
        'project-information' => 'Умные зоопарки (SmartZoos) объединяет зоопарки центральных государств балтийского региона, чтобы сформировать совместную туристическую привлекательность посредством разработки, внедрения и совместного маркетинга трансграничного пакета услуг обучения с помощью мобильных устройств.',
    ],
    'activities' => [
        'index' => [
            'heading' => 'Учебные тропы',
            'none-found' => 'Тропы не найдены.',
        ],
        'create-or-edit' => [
            'keywords' => 'Ключевое слово',
            'items-found' => 'Найденные пункты',
            'tooltips' => [
                'proximity-check' => 'Определено в том случае, если применена удалённость пункта',
            ],
            'help' => [
                'proximity' => 'Радиус удалённости установить в метрах, если значение по умолчанию: по умолчанию не подходит. Рекомендуемое значение от 25 до 100 метров. Если вы снимите флажок (галочку), расположенный справа от поля, то игра не будет определять удалённость пункта.',
            ],
        ],
    ],
    'activity-items' => [
        'index' => [
          'heading' => 'Пункты тропы',
          'none-found' => 'Пункты тропы не найдены.',
        ],
        'create-or-edit' => [
            'set-current-position' => 'Установить текущую позицию',
            'geolocation-error' => 'Ошибка: Геолокация не может быть определена',
        ],
    ],
    'discount-vouchers' => [
        'index' => [
            'heading' => 'Ваучеры на скидку',
            'none-found' => 'Ваучеры на скидку не были найдены.',
        ],
    ],
    'manage' => [
        'users' => [
            'index' => [
                'heading' => 'Управление полтзователями',
                'none-found' => 'Пользователь не найден',
                'accounts' => 'Учётные записи',
                'roles' => 'Роли',
                'manage-roles' => 'Управлять ролями',
                'remove-role' => 'Удалить роль',
                'confirmations' => [
                    'role' => 'Вы уверены, что желаете удалить выбранную роль?',
                ],
                'modal' => [
                    'title' => 'Управлять ролями пользователя',
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
