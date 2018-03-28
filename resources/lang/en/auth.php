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

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'general' => [
        'email' => 'E-Mail Address',
        'password' => 'Password',
        'confirm-password' => 'Confirm Password',
        'captcha' => 'Captcha',
    ],
    'login' => [
        'form' => [
            'heading' => 'Log in',
            'text' => 'Jaunt through the zoo and collect pieces of a puzzle. If you get a complete picture, you can redeem it for discounts in the zoo shops and the entrance.',
            'remember' => 'Remember Me',
            'btn' => [
                'login' => 'Log in',
                'reset' => 'Forgot Your Password?',
                'google' => 'Sign in with Google',
                'facebook' => 'Sign in with Facebook',
                'email' => 'Sign in with E-mail',
                'register-account' => 'Register Account',
            ],
            'choose-login-method'=> 'Choose login method',
            'or' => 'or',
        ],
    ],
    'register' => [
        'form' => [
            'heading' => 'Register',
            'name' => 'Name',
            'btn' => [
                'register' => 'Register',
            ],
            'labels' => [
                'agree-to-terms-and-policy' => 'Agree to <a href=":terms" target="_blank">terms and conditions</a> and <a href=":policy" target="_blank">privacy policy</a>',
            ],
        ],
    ],
    'reset' => [
        'form' => [
            'heading' => 'Reset Password',
            'btn' => [
                'send-password-reset-link' => 'Send Password Reset Link',
                'reset-password' => 'Reset Password',
            ],
        ],
    ],
    'logout' => [
        'form' => [
            'btn' => [
                'logout' => 'Logout',
            ],
        ],
    ],

];
