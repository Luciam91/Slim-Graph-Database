<?php
$config = require_once __DIR__ . '/../settings.php';

$devConfig = [
    'settings' => [
        'redis' => [
            'connection' => [
                'host' => 'redis',
                'port' => 6379
            ]
        ]
    ],
];

return array_replace_recursive($config, $devConfig);
