<?php
session_start();
include '../includes/db.php';

$error_message = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Fetch user/admin based on email and role
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = ?");
    $stmt->execute([$email, $role]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        if ($role === 'user') {
            $_SESSION['user_id'] = $user['id'];
            header("Location: ../user_db.php");
            exit();
        } elseif ($role === 'admin') {
            $_SESSION['admin_id'] = $user['id'];
            header("Location: ../admin/dashboard.php");
            exit();
        }
    } else {
        $error_message = "Invalid email, password, or role.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/validate.css">
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    <?php if (!empty($error_message)) : ?>
        <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter password" required>

        <label>Login As</label>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="form-footer">
        <p>Don’t have an account? <a href="register.php">Sign up</a></p>
    </div>
</div>
</body>
</html>
