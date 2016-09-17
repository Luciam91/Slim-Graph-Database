<?php
$config = require_once __DIR__ . '/../settings.php';

$devConfig = [
    'settings' => [
        'redis' => [
            'connection' => [
                'host' => 'redis',
                'port' => 6379
            ]
        ],
        'neo4j' => [
            'connection' => [
                'host' => 'neo4j',
                'username' => 'neo4j',
                'password' => 'dummy',
                'port' => 7474,
                'protocol' => 'http'
            ]
        ],
    ]
];

return array_replace_recursive($config, $devConfig);
