<?php
require_once __DIR__ . '/../config/db.php';

$q = trim($_GET['q'] ?? '');

$sql = "
SELECT m.*, g.name AS genre, c.name AS cast_name
FROM movies m
LEFT JOIN genres g ON m.genre_id = g.id
LEFT JOIN cast_members c ON m.cast_id = c.id
WHERE m.title LIKE ?
ORDER BY m.title
";

$stmt = $pdo->prepare($sql);
$stmt->execute(["%$q%"]);
echo json_encode($stmt->fetchAll());
