<?php
// admin protection
require_once __DIR__ . '/../admin/auth.php';

// bootstrap loads Twig + DB ($twig, $pdo)
require_once __DIR__ . '/../../bootstrap.php';

// fetch cast members
$stmt = $pdo->query("SELECT * FROM cast_members ORDER BY name ASC");
$casts = $stmt->fetchAll();

// render twig
echo $twig->render('cast/index.twig', [
    'casts' => $casts
]);
