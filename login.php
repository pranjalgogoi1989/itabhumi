<?php
require_once 'config/config.php';
require_once 'security/csrf.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (!validateCSRF($_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user) {

        // Check lockout
        if ($user['locked_until'] && strtotime($user['locked_until']) > time()) {
            die("Account locked. Try again later.");
        }

        if (password_verify($password, $user['password'])) {

            session_regenerate_id(true);

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Reset failed attempts
            $pdo->prepare("UPDATE users SET failed_attempts = 0, locked_until = NULL WHERE id = ?")
                ->execute([$user['id']]);

            header("Location: dashboard.php");
            exit();

        } else {

            $failed = $user['failed_attempts'] + 1;

            $lockTime = null;
            if ($failed >= 5) {
                $lockTime = date("Y-m-d H:i:s", strtotime("+15 minutes"));
            }

            $pdo->prepare("UPDATE users SET failed_attempts = ?, locked_until = ? WHERE id = ?")
                ->execute([$failed, $lockTime, $user['id']]);

            $error = "Invalid credentials.";
        }
    } else {
        $error = "Invalid credentials.";
    }
}
?>

<form method="POST">
    <h2>Login</h2>
    <p style="color:red"><?= htmlspecialchars($error) ?></p>

    <input type="hidden" name="csrf_token" value="<?= generateCSRF() ?>">

    <input type="text" name="username" required placeholder="Username"><br><br>
    <input type="password" name="password" required placeholder="Password"><br><br>

    <button type="submit">Login</button>
</form>