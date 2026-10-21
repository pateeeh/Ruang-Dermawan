<?php

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['transaction_csrf_token'])) {
    $_SESSION['transaction_csrf_token'] = bin2hex(random_bytes(32));
}

function transaction_csrf_token(): string
{
    return $_SESSION['transaction_csrf_token'];
}

function transaction_escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
