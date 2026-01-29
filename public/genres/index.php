<?php
require_once __DIR__ . '/../admin/auth.php';
require_once __DIR__ . '/../../bootstrap.php';

$genres = $pdo->query("SELECT * FROM genres ORDER BY name")->fetchAll();

echo $twig->render('genres/index.twig', [
    'genres' => $genres
]);
