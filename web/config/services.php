<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => 'your-mailgun-domain',
        'secret' => 'your-mailgun-key',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model' => 'App\User',
        'key' => '',
        'secret' => '',
    ],

    'facebook' => [
        'client_id' => '194334174266198',
        'client_secret' => '8b24a6feee1aac64a3ce24a77ed9b5a4',
        'redirect' => 'http://localhost:7070/public/auth/facebook/callback',
    ],

];
