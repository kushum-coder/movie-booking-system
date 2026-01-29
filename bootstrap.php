<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/config/csrf.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');

$twig = new \Twig\Environment($loader, [
    'autoescape' => 'html',
    'cache' => false
]);

$twig->addFunction(new \Twig\TwigFunction('csrf_token', 'csrf_token'));
$twig->addGlobal('session', $_SESSION);
