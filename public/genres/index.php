<?php
// admin protection
require_once __DIR__ . '/../admin/auth.php';

// bootstrap loads Twig + DB ($twig, $pdo)
require_once __DIR__ . '/../../bootstrap.php';

// fetch genres
$stmt = $pdo->query("SELECT * FROM genres ORDER BY name ASC");
$genres = $stmt->fetchAll();

// render twig
echo $twig->render('genres/index.twig', [
    'genres' => $genres
]);
