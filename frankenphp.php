<?php

return [
    'document_root' => __DIR__ . '/public',

    'adapter' => \FrankenPhp\Laravel\LaravelAdapter::class,

    'workers' => [
        [
            'type' => 'http',
            'workers' => 2,
        ],
    ],
];
