<?php
require_once __DIR__ . '/../admin/auth.php';
require_once __DIR__ . '/../../bootstrap.php';

$casts = $pdo->query("SELECT * FROM cast_members ORDER BY name")->fetchAll();

echo $twig->render('cast/index.twig', [
    'casts' => $casts
]);
