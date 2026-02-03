<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/csrf.php';

/*
|--------------------------------------------------------------------------
| ADMIN AUTH GUARD
|--------------------------------------------------------------------------
*/
$currentPath = $_SERVER['REQUEST_URI'];

$isLoginPage = str_contains($currentPath, '/admin/login.php');

if (!$isLoginPage && empty($_SESSION['admin'])) {
    header('Location: /movie-booking-system/public/admin/login.php');
    exit;
}

/*
|--------------------------------------------------------------------------
| TWIG
|--------------------------------------------------------------------------
*/
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');

$twig = new \Twig\Environment($loader, [
    'autoescape' => 'html'
]);

$twig->addFunction(new \Twig\TwigFunction('csrf', 'csrf_token'));
