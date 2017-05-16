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
   'language' => 'Language',
   'languages' => [
       'en' => 'English',
       'et' => 'Estonian',
       'ru' => 'Russian',
       'fi' => 'Finnish',
       'swe' => 'Swedish',
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
           'featured-image' => 'Freatured Image',
           'zoo' => 'Zoo',
           'question-type' => 'Question Type',
           'location' => 'Location',
           'activity-items' => 'Activity Items',
           'proximity' => 'Proximity',
           'search-text' => 'Search text',
       ],
       'help' => [
           'playing-time' => 'Activity time in minutes',
           'difficulty-level' => 'Choose a suitable range from available values. Defaults to all included.',
           'featured-image' => 'An image in JPEG or PNG format. Uploaded image will be resized to 800 by 800 pixels.',
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
       ],
       'placeholders' => [
           'keyword-or-title' => 'Type a keyword or title',
           'option-text' => 'Option text...',
           'embedded-content' => 'Please add any embed codes here',
           'search-text' => 'Enter a text fragment to search for',
       ],
       'options' => [
           'any' => 'Any',
       ]
   ],
   'actions' => [
       'create' => 'Create',
       'edit' => 'Edit',
       'delete' => 'Delete',
       'play' => 'Play',
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
];
