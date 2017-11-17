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
            ],
            'social-networks'=> 'Or login with social networks',
        ],
    ],
    'register' => [
        'form' => [
            'heading' => 'Register',
            'name' => 'Name',
            'btn' => [
                'register' => 'Register',
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
