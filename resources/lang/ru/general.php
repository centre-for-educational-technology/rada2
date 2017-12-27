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
       'complete' => 'Завершённая тропа',
       'ongoing' => 'Текущая тропа',
   ],
   'discount-voucher-status' => [
       'inactive' => 'Неактивный',
       'active' => 'Активный',
   ],
   'language' => 'Язык',
   'languages' => [
       'en' => 'Английский',
       'et' => 'Эстонский',
       'ru' => 'Русский',
       'fi' => 'Финский',
       'sv' => 'Шведский',
   ],
   'zoos' => [
     'skansen' => 'Скансен',
     'korkeasaari' => ' Зоопарк Хельсинки Korkeasaari',
     'tallinn' => 'Таллиннский зоопарк',
   ],
   'question-types' => [
     'one-correct-answer' => 'Один верный ответ',
     'multiple-correct-answers' => 'Несколько верных ответов',
     'freeform-answer' => 'Открытый ответ',
     'match-pairs' => 'Найди пары',
     'embedded-content' => 'Встроенный контент',
     'photo' => 'Фото',
     'information' => 'Информация',
   ],
   'forms' => [
       'labels' => [
           'title' => 'Название',
           'description' => 'Описание',
           'difficulty-level' => 'Уровень сложности',
           'playing-time' => 'Время прохождения тропы',
           'contact-information' => 'Контакт',
           'featured-image' => 'Изображение обложки',
           'zoo' => 'Зоопарк',
           'question-type' => 'Тип вопроса',
           'location' => 'Расположение',
           'activity-items' => 'Пункты тропы',
           'proximity' => 'Удалённость',
           'search-text' => 'Поиск текста',
           'read-more' => 'Читать больше',
           'image' => 'Изображение',
           'duration' => 'Продолжительность',
           'status' => 'Статус',
           'discount-voucher' => 'Ваучер на скидку',
           'access-code' => 'Код доступа',
           'amount' => 'Количество',
           'hide-incognito' => 'Скрыть инкогнито',
           'hide-incomplete' => 'Скрыть частично',
           'from' => 'С',
           'until' => 'до',
           'question-or-information' => 'Вопрос или информация',
       ],
       'help' => [
           'playing-time' => 'Время прохождения тропы в минутах',
           'image' => 'Изображение в формате JPEG или PNG. Размер загружаемого изображения должен быть 800х800 пикселей.',
           'map' => 'Пожалуйста, выберите парвильный зоопарк и перетащите маркер в определённое местоположение.',
           'question-types' => [
               'information' => 'Текст описания будет отображаться как информация для местоположения.',
               'freeform-answer' => 'Игроку будет отображаться вложенное текстовое поле.',
               'embedded-content' => 'Вставленный код, добавленный в текстовое поле, будет отображаться игроку.',
               'photo' => 'Игрок сможет отправить существующую фотографию или взять ее в качестве ответа.',
           ],
       ],
       'buttons' => [
           'create' => 'Создать',
           'save' => 'Сохранить',
           'cancel' => 'Отменить',
           'close' => 'Закрыть',
           'submit' => 'Подтвердить',
           'search' => 'Поиск',
           'load-more' => 'Загрузить больше',
           'add-option' => 'Добавить вариант',
           'reset' => 'Повторить',
           'apply-filters' => 'Применить фильтры',
           'search-activity-items' => 'Поиск пунктов тропы',
           'create-new-activity-item' => 'Создать новый пункт тропы',
           'login-or-register' => 'Войти/Зарегистрироваться',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Напечатайте ключевое слово или название',
           'option-text' => 'Текст варианта...',
           'embedded-content' => 'Пожалуйста, добавьте сюда какой-либо вставленный код',
           'search-text' => 'Введите фрагмент текста для поиска',
           'read-more' => 'Введите адрес URL, где есть больше информации по теме',
           'name-or-email' => 'Имя или эл.адрес',
           'access-code' => 'Код или текст для доступа к вопросу без ограничений местоположения',
           'datetime' => 'Дата или Дата и Время',
           'question-or-information' => 'Пожалуйста, напишите вопрос или информацию, в зависимости от выбранного типа вопроса',
       ],
       'options' => [
           'any' => 'Любые',
       ],
       'addons' => [
           'hours' => 'Часы',
           'awarded' => 'Награждён',
       ],
       'tooltips' => [
           'remove-image' => 'Установите флажок, чтобы удалить существующее изображение',
       ],
   ],
   'actions' => [
       'create' => 'Создать',
       'edit' => 'Редактировать',
       'delete' => 'Удалить',
       'play' => 'Играть',
       'send-to-backpack' => 'Отправить в рюкзак',
       'download-baked-badge' => 'Download baked badge image',
       'assertion-open' => 'Open badge assertion URL',
       'discount-voucher-spend' => 'Spend Discount Voucher',
       'get-qr-code' => 'Get QR Code',
   ],
   'minutes' => 'minutes',
   'confirmations' => [
       'delete' => 'Are you sure you want to delete this item?',
   ],
   'date-time' => [
       'formats' => [
           'short' => 'F d, Y',
           'medium' => 'F d, Y H:i',
           'long' => 'F d, Y, H:i:s',
       ],
       'created-at' => 'Created at',
       'updated-at' => 'Updated at',
   ],
   'roles' => [
       'admin' => 'Administrator',
       'zooAdmin' => 'Administrator',
       'zooMember' => 'Member',
   ],
   'difficulty-level' => [
     'easy' => 'Easy',
     'medium' => 'Medium',
     'hard' => 'Hard',
   ],
   'cookie-consent' => [
       'text' => 'This website uses cookies to ensure you get the best possible online experience. By continuing to use our website, you agree to the use of cookies.',
       'button-agree' => 'Agree',
   ],
];
