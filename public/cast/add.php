<?php
// admin protection
require_once __DIR__ . '/../admin/auth.php';

// load twig, db, csrf
require_once __DIR__ . '/../../bootstrap.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'] ?? '')) {
        die('Invalid CSRF token');
    }

    $name = trim($_POST['name'] ?? '');

    // validation
    if ($name === '') {
        $errors[] = 'Cast member name is required';
    }

    // duplicate check
    if (!$errors) {
        $stmt = $pdo->prepare("SELECT id FROM cast_members WHERE name = ?");
        $stmt->execute([$name]);
        if ($stmt->fetch()) {
            $errors[] = 'Cast member already exists';
        }
    }

    // insert
    if (!$errors) {
        $stmt = $pdo->prepare("INSERT INTO cast_members (name) VALUES (?)");
        $stmt->execute([$name]);

        header('Location: index.php');
        exit;
    }
}

echo $twig->render('cast/form.twig', [
    'heading' => 'Add Cast Member',
    'button'  => 'Add Cast',
    'cast'    => $_POST ?? [],
    'errors'  => $errors,
    'csrf'    => csrf_token()
]);
