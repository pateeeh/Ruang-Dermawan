<?php

function transaction_database(): PDO
{
    $host = getenv('DB_HOST');
    $database = getenv('DB_NAME');
    $username = getenv('DB_USER');
    $password = getenv('DB_PASSWORD');

    if ($host === false || $database === false || $username === false || $password === false) {
        throw new RuntimeException('Konfigurasi database belum lengkap.');
    }

    $port = getenv('DB_PORT');
    $port = $port === false || $port === '' ? '3306' : $port;
    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $database);

    return new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
}
