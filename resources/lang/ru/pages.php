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
                'heading' => 'Приложение Умные зоопарки (SmartZoos), что это такое?',
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
                'heading' => 'Управление пользователями',
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
            'heading' => 'Статистика',
            'users' => 'Пользователи',
            'activities' => 'Тропы',
            'activity-items' => 'Пункты тропы',
            'games' => 'Игры',
            'discount-vouchers' => 'Ваучеры',
            'captions' => [
                'activities-by-zoo' => 'Тропы зоопарка',
                'activities-by-language' => 'Тропы по языку',
                'activity-items-by-zoo' => 'Пункты тропы зоопарка',
                'activity-items-by-question-type' => 'Пункты тропы по типу вопроса',
                'activity-items-by-language' => 'Пункты тропы по языку',
                'games-by-status' => 'Игры по статусу',
            ],
            'columns' => [
                'discount-vouchers-total' => 'Всего ваучеров',
                'discount-vouchers-redeemed' => 'Выкупленные ваучеры',
            ],
        ],
    ],
    'play' => [
        'game' => [
            'loading' => 'Игра загружается ...',
            'its-you' => 'Вы здесь',
            'info' => 'Информация по игре',
            'position-tracking' => 'Включение или отключение отслеживания местоположения',
            'exit' => 'Выйти из текущей игры',
            'exit-confirmation' => 'Вы уверены, что желаете выйти из игры? Только аутентифицированные пользователи смогут продолжить игру позже.',
            'change-map-type' => 'Изменить тип карты',
            'textual-answer-placeholder' => 'Текст ответа...',
            'image-format-hint' => 'Пожалуйста, используйте изображения только в формате PNG или JPG / JPEG.',
            'apply-item-bounds' => 'Показать все доступные местоположения пунктов тропы на карте',
            'results-heading' => 'Это ваши результаты',
            'number-of-questions' => 'Номер вопроса',
            'gps-error' => 'Сигнал геопозиции (GPS) не найден.',
            'go' => 'ИДИ!',
            'back' => 'Назад',
            'next' => 'Следующий',
            'got-it' => 'Получить это!',
            'read-more-about' => 'Читать больше...',
            'tips-text' => 'Некоторые советы перед началом',
            'access-code-placeholder' => 'Введите код или текст, чтобы переопределить ограничение позиции',
            'not-logged-in' => 'Not logged in',
            'complete' => 'Complete!',
            'icons' => [
                'help' => 'Каждый значок (флажок) имеет цветовой код, указывающий на состояние вопроса.',
                'active' => 'Неотвеченный',
                'inactive' => 'Вне зоны',
                'correct' => 'Верный ответ',
                'incorrect' => 'Неверный ответ',
            ],
            'items' => [
                'gameplay_instructions' => [
                    'title' => 'How to play',
                    'description' => 'Investigate the location, find and complete all the tasks!',
                ],
                'look_closely' => [
                    'title' => 'Посмотрите вокруг',
                    'description' => 'Посмотрите внимательно вокруг себя для поиска подсказок. Вы никогда не знаете, где найдете ответы!',
                ],
                'look_out' => [
                    'title' => 'Будьте осторожны!',
                    'description' => 'Помните, куда вы идёте, чтобы не нанести вреда себе или другим',
                ],
                'do_not_disturb' => [
                    'title' => ', Пожалуйста, не шумите',
                    'description' => 'Победа - это замечательно, но, пожалуйста, не пугайте животных',
                ],
                'help_others' => [
                    'title' => 'Помогите друг другу',
                    'description' => 'Помогите своему другу и радуйтесь вместе!',
                ],
            ],
        ],
    ],
    'dashboard' => [
        'title' => 'Dashboard',
        'heading' => 'Добро пожаловать,  :имя!',
        'none-found' => 'Игры или тропы не найдены',
        'games-and-activities' => 'Игры и тропы',
        'finished' => 'Закончили :дата',
        'started' => 'Начали :дата',
        'btn' => [
            'view-results' => 'Посмотреть результаты',
            'continue' => 'Продолжить',
        ],
    ],
    'activity-results-index' => [
        'title' => 'Тропы',
        'heading' => 'Результаты прохождения троп',
        'zoos' => 'Отображённые тропы относятся к этим зоопаркам',
    ],
    'activity-results' => [
        'heading' => 'Результаты <strong>:title</strong>',
        'btn' => [
            'download-player-positions' => 'Скачать местоположения игрока',
        ],
    ],
    'profile' => [
        'title' => 'Профиль',
        'heading' => 'Профиль игрока :имя',
        'labels' => [
            'badges-earned' => 'Полученные значки',
            'discount-vouchers-earned' => 'Полученные ваучеры на скидку',
            'valid-until' => 'Действителен до',
        ],
        'confirmations' => [
            'discount-voucher-spend' => 'Вы уверены, что желаете использовать этот ваучер на скидку?',
        ],
        'discount-vouchers' => [
            'information' => 'Vouchers are rewarded for completing Activities. Show the voucher to the staff to redeem. All vouchers are valid for a certain period of time and could only be redeemed within a certain time frame.',
            'how-to-redeem' => 'Please let the staff member press the button and confirm the process. This can not be undone.',
        ],
    ],
    'profile-edit' => [
        'help' => [
            'password' => 'Пожалуйста, оставьте поле пароля пустым, если вы не хотите его изменить.',
        ]
    ],
    'badges' => [
        'introduction' => [
            'general' => 'By accomplishing certain tasks within SmartZoos, you will be rewarded with badges.',
            'authenticated' => 'The badges you have collected can be seen on your <a href=":profileUrl">Profile</a>.',
            'guest' => 'In order to collect badges, you must be <a href=":loginUrl">logged in</a>.',
        ],
    ],

];
