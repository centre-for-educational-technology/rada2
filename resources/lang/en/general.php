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
           'title' => 'Title',
           'description' => 'Description',
           'game-story-and-rules' => 'Game story and rules',
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
           'access-code-clues' => 'Access Code Clues',
           'amount' => 'Amount',
           'hide-incognito' => 'Hide incognito',
           'hide-incomplete' => 'Hide incomplete',
           'from' => 'From',
           'until' => 'Until',
           'question-or-information' => 'Question/Information',
           'promoted' => 'Promote, show special icon and put to the top of the lists',
           'pin-code' => 'PIN code'
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
           'load-more' => 'Load more',
           'add-option' => 'Add option',
           'reset' => 'Reset',
           'apply-filters' => 'Apply filters',
           'search-activity-items' => 'Search Activity Items',
           'create-new-activity-item' => 'Create new Activity Item',
           'login-or-register' => 'Login/Register',
       ],
       'placeholders' => [
           'keyword-or-title' => 'Type a keyword or title',
           'option-text' => 'Option text...',
           'embedded-content' => 'Please add any embed codes here',
           'search-text' => 'Enter a text fragment to search for',
           'read-more' => 'Enter a URL that has more information on the topic',
           'name-or-email' => 'Name or email',
           'access-code' => 'Code or text to access question without positioning restrictions',
           'access-code-clues' => 'Clues to what/where the Access Code is',
           'datetime' => 'Date or Date and Time',
           'question-or-information' => 'Please write Question or Information, depending on chosen Question Type',
       ],
       'options' => [
           'any' => 'Any',
       ],
       'addons' => [
           'hours' => 'hours',
           'awarded' => 'awarded',
       ],
       'tooltips' => [
           'remove-image' => 'Check to remove an existing image',
           'remove-selected-image' => 'Remove currently selected image',
           'mark-option-as-correct' => 'Check to mark option as correct',
       ],
       'warnings' => [
           'readd-pictures' => 'If you had added any pictures, you have to add them again. Sorry.',
       ],
       'alerts' => [
           'image-loading-text' => 'Loading ...',
           'form-submit-loading-text' => 'Loading ...'
       ]
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
       'reveal-discount' => 'Reveal discount',
   ],
   'minutes' => 'minutes',
   'confirmations' => [
       'delete' => 'Are you sure you want to delete this item?',
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
       'text' => 'This website uses cookies to ensure you get the best possible online experience. By continuing to use our website, you <a href=":policy" target="_blank">agree to the use of cookies</a>.',
       'button-agree' => 'Agree',
   ],
   'system-requirements' => 'Minimum requirements: operating system iOS (version 10) or Android 7. At least 3G internet connection and working GPS module is needed.',
   'messages' => [
       'warnings' => [
           'account-blocked' => 'This account has been suspended. For more information please contact the administration.',
           'account-email-not-verified' => 'This account has not been verified yet. Use verification instructions sent to you by email.',
       ],
       'successes' => [
           'account-email-verification-sent' => 'Your account has been created. We have sent you an email containing verification instructions.',
           'account-email-verified' => 'Your account has been successfully verified. You can now log in.',
       ],
   ],
];
