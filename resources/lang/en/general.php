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
   'forms' => [
       'labels' => [
           'activity-type' => 'Activity Type',
           'title' => 'Title',
           'description' => 'Description',
           'difficulty-level' => 'Difficulty Level',
           'playing-time' => 'Playing Time',
           'language' => 'Language',
           'contact-information' => 'Contact Information',
           'featured-image' => 'Freatured Image',
           'zoo' => 'Zoo',
       ],
       'help' => [
           'playing-time' => 'Activity time in minutes',
           'difficulty-level' => 'Choose a suitable range from available values. Defaults to all included.',
           'featured-image' => 'An image in JPEG or PNG format. Uploaded image will be resized to 800 by 800 pixels.',
       ],
       'buttons' => [
           'create' => 'Create',
           'cancel' => 'Cancel',
       ],
   ],
];
