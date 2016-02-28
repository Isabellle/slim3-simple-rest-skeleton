<?php

return [
    'settings' => [
        // Slim Settings
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => false,
        'PoweredBy' => 'PR2StudioAPI',

        // database settings
        'pdo' => [
            'dsn' => 'mysql:host=localhost;dbname=notes;charset=utf8',
            'username' => 'notes',
            'password' => 'notes',
        ],
        
        // api rate limiter settings
        'api_rate_limiter' => [
            'requests' => '200',
            'inmins' => '60',
        ],

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__.'/../log/app.log',
        ],
    ],
];
