<?php
// config.php

return [
    'database' => [
        'driver' => 'mysql', // 'mysql' veya 'sqlite'
        'host' => '127.0.0.1', // veya 'localhost'
        'port' => 3306,
        'dbname' => 'stajyer_db',
        'user' => 'root',
        'password' => '', // XAMPP kurulumunda varsayılan şifre boştur.
        'charset' => 'utf8mb4',
        'sqlite_path' => __DIR__ . '/database/stajyer_db.sqlite'
    ],
];