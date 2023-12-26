<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS Defaults
     |--------------------------------------------------------------------------
     |
     | The defaults are the default values applied to all routes.
     |
     */

    'defaults' => [
        'allow_credentials' => false,
        'allow_headers'     => ['Content-Type', 'X-Requested-With'],
        'allow_methods'     => ['*'],
        'expose_headers'    => [],
        'max_age'           => 0,
        'origin'            => '*',
    ],

    /*
     |--------------------------------------------------------------------------
     | Cross-Origin Resource Sharing (CORS) Configuration
     |--------------------------------------------------------------------------
     |
     | Here you may configure your settings for CORS.
     |
     */

    'paths' => [
        'api/*', 'sanctum/csrf-cookie',
        'sanctum/csrf-cookie',
        'login',
        'logout',
        // Add more paths as needed

    ],
    'allowed_methods' => ['*'],
    'allowed_origins' => ['http://localhost:8080/AddBook/'], // Add your frontend domain here
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'],
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false,
];
