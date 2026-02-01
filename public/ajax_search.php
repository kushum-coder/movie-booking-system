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
        m.title LIKE :title
        OR g.name LIKE :genre
        OR c.name LIKE :cast
        OR CAST(m.release_year AS CHAR) LIKE :year
        OR CAST(m.rating AS CHAR) LIKE :rating
    ORDER BY m.id DESC
");

$stmt->execute([
    ':title'  => $qLike,
    ':genre' => $qLike,
    ':cast'  => $qLike,
    ':year'  => $qLike,
    ':rating'=> $qLike
]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
