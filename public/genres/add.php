<?php
// protect admin
require_once __DIR__ . '/../admin/auth.php';

// load twig, pdo, csrf
require_once __DIR__ . '/../../bootstrap.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // CSRF check
    if (!csrf_check($_POST['csrf'] ?? '')) {
        die('Invalid CSRF token');
    }

    $name = trim($_POST['name'] ?? '');

    // VALIDATION
    if ($name === '') {
        $errors[] = 'Genre name is required';
    }

    // check duplicate
    if (!$errors) {
        $stmt = $pdo->prepare("SELECT id FROM genres WHERE name = ?");
        $stmt->execute([$name]);
        if ($stmt->fetch()) {
            $errors[] = 'Genre already exists';
        }
    }

    // insert
    if (!$errors) {
        $stmt = $pdo->prepare("INSERT INTO genres (name) VALUES (?)");
        $stmt->execute([$name]);

        header('Location: index.php');
        exit;
    }
}

// render form
echo $twig->render('genres/form.twig', [
    'heading' => 'Add Genre',
    'button'  => 'Add Genre',
    'genre'   => $_POST ?? [],
    'errors'  => $errors,
    'csrf'    => csrf_token()
]);
