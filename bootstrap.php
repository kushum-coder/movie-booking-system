<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config/db.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');

$twig = new \Twig\Environment($loader, [
    'autoescape' => 'html',
    'cache' => false
]);
