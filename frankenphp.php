<?php

return [
    // Arahkan ke direktori public
    'document_root' => __DIR__ . '/public',

    // Jalankan laravel
    'adapter' => \FrankenPhp\Laravel\LaravelAdapter::class,

    // enable workers
    'workers' => [
        [
            'type' => 'http',
            'workers' => 2,
        ],
    ]
];
