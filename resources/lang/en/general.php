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
       'complete' => 'Complete Games',
       'ongoing' => 'Ongoing Game',
       'stopped' => 'Stopped Game'
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
       'missing-word' => 'Missing word'
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
           'activity-items' => 'Tasks',
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
           'promoted' => 'Open game, players can join this game without knowing the pin code',
           'is_template' => 'Is template',
           'pin-code' => 'Game PIN code. Share the PIN code with the players to access the game.',
           'keywords' => 'Keywords',
           'enforce_items_order' => 'Enforce items order',
           'subject' => 'Subjects',
           'age_of_participants' => 'Age of participants',
           'answering_time' => 'Answering time limit',
           'instructors' => 'Instructors',
           'maximum-points-available' => 'Maximum points available',
           'maximum-points-available-missing-word' => 'Completely correct answers are automatically graded, the rest need manual grading.',
           'is-flash' => 'Is flash task',
           'completed-tasks' => 'Completed tasks',
           'users-who-have-completed-the-task' => 'Users who have completed the task',
           'time' => [
               'hour' => 'H',
               'minute' => 'm',
               'second' => 's'
           ],
           'public-path' => 'Public path',
       ],
       'help' => [
           'playing-time' => 'Games time in minutes',
           'image' => 'An image in JPEG or PNG format. Uploaded image will be resized to 800 by 800 pixels.',
           'map' => 'Please select the correct Zoo and drag the marker to the specific location.',
           'question-types' => [
               'information' => 'Description text will be displayed as an information for the location.',
               'freeform-answer' => 'Input textarea will be displayed to the player.',
               'embedded-content' => 'Embed code added into the textarea will be displayed to the player.',
               'photo' => 'Player will be able to submit an existing photo or take one as an answer.',
               'missing-word' => 'Wrap missing words inside curly brackets. E.g. "Capital of Estonia is {Tallinn}".'
           ],
           'keywords' => 'Separate keywords with commas',
           'instructors' => 'Users can be searched by name and email.'
       ],
       'buttons' => [
           'create' => 'Create',
           'save' => 'Save',
           'cancel' => 'Cancel',
           'close' => 'Close',
           'open' => 'Open',
           'submit' => 'Submit',
           'search' => 'Search',
           'load-more' => 'Load more',
           'add-option' => 'Add option',
           'reset' => 'Reset',
           'apply-filters' => 'Apply filters',
           'search-activity-items' => 'Search Tasks',
           'create-new-activity-item' => 'Create new Task',
           'login-or-register' => 'Login/Register',
           'add' => 'Add',
           'details' => 'Details',
           'remove-selected-image' => 'Remove selected image',
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
           'missing-word' => 'Enter a text with missing words here',
           'pin-placeholder' => 'INSERT PIN',
           'pts' => 'pts',
           'enter-your-name' => 'Enter your name here'
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
           'public-path' => 'All results will be public during and after the gameplay',
       ],
       'warnings' => [
           'readd-pictures' => 'If you had added any pictures, you have to add them again. Sorry.',
           'no_results_found' => 'No results found for this query!'
       ],
       'alerts' => [
           'image-loading-text' => 'Loading ...',
           'form-submit-loading-text' => 'Loading ...'
       ]
   ],
   'actions' => [
       'create' => 'Create',
       'duplicate' => 'Generate duplicate',
       'edit' => 'Edit',
       'delete' => 'Delete',
       'play' => 'Play',
       'discount-voucher-spend' => 'Spend Discount Voucher',
       'reveal-discount' => 'Reveal discount',
       'mark-started' => 'Mark game as started',
       'mark-stopped' => 'Mark game as stopped',
       'start' => 'Start',
       'stop' => 'Stop'
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
   'structural-aid' => 'This project has been supported through and according to Mobilitas Plus MOBEC001 "Cross-Border Educational Innovation thru Technology-Enhanced Research" action plan.',
   'messages' => [
       'warnings' => [
           'account-blocked' => 'This account has been suspended. For more information please contact the administration.',
           'account-email-not-verified' => 'This account has not been verified yet. Use verification instructions sent to you by email.',
       ],
       'successes' => [
           'account-email-verification-sent' => 'Your account has been created. We have sent you an email containing verification instructions.',
           'account-email-verified' => 'Your account has been successfully verified. You can now log in.',
       ],
       'error' => [
           'game-not-found' => 'Game not found',
           'invalid-pin-code' => 'Invalid pin code',
           'missing-word' => 'At least one missing word must be entered.'
       ],
       'notifications' => [
           'new-flash-message' => [
               'title' => 'A flash exercise was activated!',
               'message' => 'Flash exercises are available for limited time only so act quickly! Click the flashing <i class="mdi mdi-flash"></i> icon to access the flash task!'
           ]
       ]
   ],
    'activity' => [
        'subject' => [
            'arts' => 'Arts',
            'biology' => 'Biology',
            'Cchemistry' => 'Chemistry',
            'crafts' => 'Crafts',
            'english' => 'English',
            'ethics' => 'Ethics',
            'estonian' => 'Estonian',
            'french' => 'French',
            'geography' => 'Geography',
            'german' => 'German',
            'health_education' => 'Health-education',
            'higher_education_studies' => 'Higher education studies',
            'history' => 'History',
            'maths' => 'Maths',
            'matural_sciences' => 'Natural sciences',
            'other' => 'Other',
            'philosophy' => 'Philosophy',
            'physics' => 'Physics',
            'psychology' => 'Psychology',
            'spanish' => 'Spanish'
        ]
    ],
    'components' => [
        'image-upload' => [
            'input-text' => 'Upload or add an image from registries',
            'tabs' => [
                'upload' => 'Upload',
                'cultural-monuments-registry' => 'National registry of cultural monuments',
            ],
            'ajapaik' => [
                'results' => 'Results:',
            ],
        ],
    ],
];
