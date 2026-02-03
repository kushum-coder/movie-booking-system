<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

if (!empty($_SESSION['admin'])) {
    header('Location: ../index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$_POST['username'] ?? '']);
    $admin = $stmt->fetch();

    if ($admin && password_verify($_POST['password'] ?? '', $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        header('Location: ../index.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <script src="../../assets/js/main.js" defer></script>
</head>
<body>

<div class="centered" style="min-height:100vh;">
    <div class="card login-card">
        <h2 style="text-align:center;margin-bottom:20px;">Admin Login</h2>

        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="post" autocomplete="off">
            <input type="text" style="display:none">
            <input type="password" style="display:none">

            <input type="text" name="username" placeholder="Username" required>

            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="toggle" onclick="togglePassword()">Show</span>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</div>

</body>
</html>
