<?php
session_start();
include '../includes/db.php';

// Redirect if not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch current user data
$stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit();
}

// Handle form update
$success = $error = "";
if (isset($_POST['update_profile'])) {
    $new_username = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    $new_password = trim($_POST['password']);

    $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);

    $update = $conn->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
    if ($update->execute([$new_username, $new_email, $hashedPassword, $user_id])) {
        $success = "✅ Profile updated successfully!";
        $stmt->execute([$user_id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $error = "❌ Failed to update profile. Try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #2c3e50; /* Dark background */
            margin: 0;
            padding: 0;
            color: #ecf0f1;
        }
        header {
            position: fixed;
            top: 0; left: 0; right: 0;
            background: #ff5833d8; /* Orange-red header */
            color: white;
            padding: 15px 30px;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            z-index: 1000;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        .container {
            width: 50%;
            margin: 100px auto 50px auto;
            background: #34495e; /* Card background */
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        h2 {
            text-align: center;
            color: #ff5833d8;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #ecf0f1;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #7f8c8d;
            border-radius: 4px;
            box-sizing: border-box;
            background: #2c3e50;
            color: #ecf0f1;
        }
        input:focus {
            border-color: #ff5733;
            outline: none;
        }
        button {
            background: #ff5833d8;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            width: 100%;
        }
        button:hover {
            background: #e74c3c;
        }
        .msg {
            text-align: center;
            font-weight: bold;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 4px;
        }
        .success {
            background: #27ae60;
            color: #ecf0f1;
        }
        .error {
            background: #c0392b;
            color: #ecf0f1;
        }
        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            background: #2980b9;
            color: white;
            padding: 10px 15px;
            border-radius: 4px;
        }
        .back-link:hover {
            background: #1f6391;
        }
    </style>
</head>
<body>
<header>
    My Profile
</header>

<div class="container">
    <h2>Profile Details</h2>

    <?php if ($success): ?>
        <p class="msg success"><?= $success ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p class="msg error"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>User ID (Read Only)</label>
        <input type="text" value="<?= htmlspecialchars($user['id']) ?>" disabled>

        <label>Username</label>
        <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Enter new password" required>

        <button type="submit" name="update_profile">Update Profile</button>
    </form>

    <a href="../user_db.php" class="back-link">⬅ Back to Home</a>
</div>
</body>
</html>
