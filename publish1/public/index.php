<?php
session_start();

if (empty($_SESSION['admin'])) {
    header('Location: admin/login.php');
    exit;
}

require_once __DIR__ . '/../bootstrap.php';

$stmt = $pdo->query("
    SELECT 
        m.*,
        g.name AS genre_name,
        c.name AS cast_name
    FROM movies m
    LEFT JOIN genres g ON m.genre_id = g.id
    LEFT JOIN cast_members c ON m.cast_id = c.id
    ORDER BY m.id DESC
");

$movies = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo $twig->render('movies.twig', [
    'movies' => $movies
]);
