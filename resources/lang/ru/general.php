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
           'access-code-clues' => 'Доступ к кодам доступа',
           'amount' => 'Количество',
           'hide-incognito' => 'Скрыть инкогнито',
           'hide-incomplete' => 'Скрыть частично',
           'from' => 'С',
           'until' => 'до',
           'question-or-information' => 'Вопрос или информация',
           'promoted' => 'Продвигайте, показывайте специальный значок и помещайте в начало списка',
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
           'access-code-clues' => 'Ключи к коду доступа/туда, где код доступа',
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
           'remove-selected-image' => 'Удалить в данный момент выбранное изображение',
           'mark-option-as-correct' => 'Установите флажок как правильный',
       ],
       'warnings' => [
           'readd-pictures' => 'Если вы добавили какие-либо фотографии, вы должны добавить их снова. Приносим извинения.',
       ],
   ],
   'actions' => [
       'create' => 'Создать',
       'edit' => 'Редактировать',
       'delete' => 'Удалить',
       'play' => 'Играть',
       'send-to-backpack' => 'Отправить в рюкзак',
       'download-baked-badge' => 'Загрузить изображение встроенным в значок',
       'assertion-open' => 'Открыть URL-адрес подтверждения значка',
       'discount-voucher-spend' => 'Использовать ваучер на скидку',
       'get-qr-code' => 'Получить QR-код',
       'reveal-discount' => 'Показать скидку',
   ],
   'minutes' => 'Минуты',
   'confirmations' => [
       'delete' => 'Вы уверены, что желаете удалить этот пункт?',
       'play' => 'You are not logged in! - Progress will not be saved and any rewards cannot be claimed.',
       'block-account' => 'Are you sure you want to block selected account?',
       'unblock-account' => 'Are you sure you want to unblock selected account?',
       'delete-account' => 'Are you sure you want to delete selected account? This can not be undone and would also delete any content created by the user!',
       'unload-protection' => 'You may have unsaved changes. Do you still want to leave?',
   ],
   'date-time' => [
       'formats' => [
           'short' => 'F d, Y',
           'medium' => 'F d, Y H:i',
           'long' => 'F d, Y, H:i:s',
       ],
       'created-at' => 'Создано',
       'updated-at' => 'Обновлено',
   ],
   'roles' => [
       'admin' => 'Администратор',
       'zooAdmin' => 'Администратор',
       'zooMember' => 'Член',
   ],
   'difficulty-level' => [
     'easy' => 'Простой',
     'medium' => 'Средний',
     'hard' => 'Сложный',
   ],
   'cookie-consent' => [
       'text' => 'Для повышения эффективности работы нашего сайта мы используем cookie. Продолжая использовать наш веб-сайт, вы <a href=":policy" target="_blank">соглашаетесь на использование файлов cookie</a>.',
       'button-agree' => 'Согласен',
   ],
   'system-requirements' => 'Minimum requirements: operation system iOS (version 10) or Android 7. At least 3G internet connection and working GPS module is needed.',
   'messages' => [
       'warnings' => [
           'account-blocked' => 'This account has been suspended. For more information please contact administration.',
           'account-email-not-verified' => 'This account has not been verified yet. Use verification instructions sent to you by email.',
       ],
       'successes' => [
           'account-email-verification-sent' => 'Your account has been created. We have sent you an email containing verification instructions.',
           'account-email-verified' => 'Your account has been successfuly verified. You can now log in.',
       ],
   ],
];
