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

   'activity-type' => [
       'collecting-cards' => 'Collecting Cards',
       'treasure-hunt' => 'Treasure Hunt',
   ],
   'activity-status' => [
       'complete' => 'Complete Activity',
       'ongoing' => 'Ongoing Activity',
   ],
   'discount-voucher-status' => [
       'inactive' => 'Inactive',
       'active' => 'Active',
   ],
   'language' => 'Language',
   'languages' => [
       'en' => 'English',
       'et' => 'Estonian',
       'ru' => 'Russian',
       'fi' => 'Finnish',
       'sv' => 'Swedish',
   ],
   'zoos' => [
     'skansen' => 'Skansen',
     'korkeasaari' => 'Korkeasaari',
     'tallinn' => 'Tallinn Zoo',
   ],
   'question-types' => [
     'one-correct-answer' => 'One correct answer',
     'multiple-correct-answers' => 'Multiple correct answers',
     'freeform-answer' => 'Freeform answer',
     'match-pairs' => 'Match pairs',
     'embedded-content' => 'Embedded content',
     'photo' => 'Photo',
     'information' => 'Information',
   ],
   'forms' => [
       'labels' => [
           'activity-type' => 'Activity Type',
           'title' => 'Title',
           'description' => 'Description',
           'difficulty-level' => 'Difficulty Level',
           'playing-time' => 'Playing Time',
           'contact-information' => 'Contact Information',
           'featured-image' => 'Featured Image',
           'zoo' => 'Zoo',
           'question-type' => 'Question Type',
           'location' => 'Location',
           'activity-items' => 'Activity Items',
           'proximity' => 'Proximity',
           'search-text' => 'Search text',
           'read-more' => 'Read more',
           'image' => 'Image',
           'duration' => 'Duration',
           'status' => 'Status',
           'discount-voucher' => 'Discount Voucher',
           'access-code' => 'Access Code',
           'amount' => 'Amount',
           'hide-incognito' => 'Hide incognito',
           'hide-incomplete' => 'Hide incomplete',
           'from' => 'From',
           'until' => 'Until',
       ],
       'help' => [
           'playing-time' => 'Activity time in minutes',
           'image' => 'An image in JPEG or PNG format. Uploaded image will be resized to 800 by 800 pixels.',
           'map' => 'Please select the correct Zoo and drag the marker to the specific location.',
           'question-types' => [
               'information' => 'Description text will be displayed as an information for the location.',
               'freeform-answer' => 'Input textarea will be displayed to the player.',
               'embedded-content' => 'Embed code added into the textarea will be displayed to the player.',
               'photo' => 'Player will be able to submit an existing photo or take one as an answer.',
           ],
       ],
       'buttons' => [
           'create' => 'Create',
           'save' => 'Save',
           'cancel' => 'Cancel',
           'close' => 'Close',
           'submit' => 'Submit',
           'search' => 'Search',
           'add-activity-items' => 'Add activity items',
           'load-more' => 'Load more',
           'add-option' => 'Add option',
           'reset' => 'Reset',
           'apply-filters' => 'Apply filters',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Type a keyword or title',
           'option-text' => 'Option text...',
           'embedded-content' => 'Please add any embed codes here',
           'search-text' => 'Enter a text fragment to search for',
           'read-more' => 'Enter a URL that has more information on the topic',
           'name-or-email' => 'Name or email',
           'access-code' => 'Code or text to access question without positioning restrictions',
           'datetime' => 'Date or Date and Time',
       ],
       'options' => [
           'any' => 'Any',
       ],
       'addons' => [
           'hours' => 'hours',
           'awarded' => 'awarded',
       ],
   ],
   'actions' => [
       'create' => 'Create',
       'edit' => 'Edit',
       'delete' => 'Delete',
       'play' => 'Play',
       'send-to-backpack' => 'Send To Backpack',
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
