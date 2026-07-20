<?php
include 'includes/db.php';

$username = "Manoj Kumar";
$email = "Manoj@gmail.com";
$password = password_hash("Manu123", PASSWORD_DEFAULT);
$role = "admin";

$stmt = $conn->prepare("INSERT INTO users (username, email, password, created_at, role) VALUES (?, ?, ?, NOW(), ?)");
$stmt->execute([$username, $email, $password, $role]);

echo "Admin created successfully!";
?>
