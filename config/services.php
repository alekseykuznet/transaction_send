<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'api' => [
        'token' => 'asd2343asdasaYdnnas89932asdasd',
    ],

    'vkontakte' => [
        'client_id' => env('VKONTAKTE_KEY'),
        'client_secret' => env('VKONTAKTE_SECRET'),
        'redirect' => env('APP_URL') . env('VKONTAKTE_REDIRECT')
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_KEY'),
        'client_secret' => env('FACEBOOK_SECRET'),
        'redirect' => env('APP_URL') . env('FACEBOOK_REDIRECT')
    ],
    'google' => [
        'client_id' => env('GOOGLE_KEY'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect' => env('APP_URL') . env('GOOGLE_REDIRECT'),
    ],
    'odnoklassniki' => [
        'client_id' => env('ODNOKLASSNIKI_KEY'),
        'client_secret' => env('ODNOKLASSNIKI_SECRET'),
        'redirect' => env('APP_URL') . env('ODNOKLASSNIKI_REDIRECT'),
        'client_public' => env('ODNOKLASSNIKI_PUBLIC_KEY')
    ],
];
