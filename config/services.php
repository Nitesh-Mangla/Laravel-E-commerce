<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'google' => [
        'client_id' => '994086502485-oopjc1r9bscaaqg09fon2rom9af4oudk.apps.googleusercontent.com',
        'client_secret' => 'NcK8RDzw73rEIuuEKlxfxY92',
        'redirect' => 'https://localhost:8080/online_shopping/public/callback'
    ],

    
    'facebook' => [
        'client_id' => '646582132454241',
        'client_secret' => 'fa19b86f6266032e4f3cff96e8928d2c',
        'redirect' => 'https://localhost:8080/online_shopping/public/facebookcallback'    
    ],

];
