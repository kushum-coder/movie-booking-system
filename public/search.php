<?php
require_once __DIR__ . '/../bootstrap.php';

$q = trim($_GET['query'] ?? '');
$movies = [];

if ($q !== '') {

    $sql = "
        SELECT 
            m.*,
            g.name AS genre_name,
            c.name AS cast_name
        FROM movies m
        LEFT JOIN genres g ON m.genre_id = g.id
        LEFT JOIN cast_members c ON m.cast_id = c.id
        WHERE 
            m.title LIKE :q
            OR g.name LIKE :q
            OR c.name LIKE :q
            OR m.release_year = :year
            OR m.rating = :rating
        ORDER BY m.id DESC
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':q' => "%$q%",
        ':year' => is_numeric($q) ? (int)$q : -1,
        ':rating' => is_numeric($q) ? (float)$q : -1
    ]);

    $movies = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

echo $twig->render('movies.twig', [
    'movies' => $movies
]);
