<?php
require_once __DIR__ . '/admin/auth.php';
require_once __DIR__ . '/../bootstrap.php';

$stmt = $pdo->query("SELECT * FROM movies ORDER BY id DESC");
$movies = $stmt->fetchAll();

echo $twig->render('movies.twig', [
    'movies' => $movies
]);
