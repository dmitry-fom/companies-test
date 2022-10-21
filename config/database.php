<?php

return [
    'default' => env('DB_CONNECTION', 'pgsql'),
    'migrations' => 'migrations',
    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATABASE'),
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'charset' => 'utf8',
            'prefix' => '',
            'schema' => env('DB_SCHEMA', 'public'),
            'extensions_schema' => env('DB_EXTENSIONS_SCHEMA', 'extensions'),
        ],
    ]
];
