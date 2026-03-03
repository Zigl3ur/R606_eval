<?php
return [
    'migrations_paths' => [
        'Eden\\R606Eval\\Migrations' => __DIR__ . '/lib/Migrations',
    ],
    'all_or_nothing' => true,
    'transactional' => true,
    'check_database_platform' => true,
    'organize_migrations' => 'none',
];
