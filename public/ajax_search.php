<?php
require_once __DIR__ . '/../config/db.php';

header('Content-Type: application/json');

$q = trim($_GET['q'] ?? '');
$qLike = "%$q%";

$stmt = $pdo->prepare("
    SELECT 
        m.id,
        m.title,
        m.release_year,
        m.rating,
        g.name AS genre_name,
        c.name AS cast_name
    FROM movies m
    LEFT JOIN genres g ON m.genre_id = g.id
    LEFT JOIN cast_members c ON m.cast_id = c.id
    WHERE
        m.title LIKE :q
        OR g.name LIKE :q
        OR c.name LIKE :q
        OR m.release_year LIKE :q
        OR m.rating LIKE :q
    ORDER BY m.id DESC
");

$stmt->execute(['q' => $qLike]);
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
