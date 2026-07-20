<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// DB connection
$host = "localhost";   // change if needed
$user = "root";        // your DB username
$pass = "";            // your DB password
$dbname = "ecommerce"; // your DB name

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$admin_id = $_SESSION['admin_id'];
$sql = "SELECT id, username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
   <link rel="stylesheet" href="../css/admin_db.css">
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <div>
        <span>Welcome, <?php echo htmlspecialchars($admin['username']); ?></span>
        <a href="logout.php">Logout</a>
    </div>
</header>

<div class="sidebar">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="add_product.php">➕ Add Product</a>
    <a href="manage_products.php">📦 Manage Products</a>
    <a href="../pages/logout.php" class="logout">🚪 Logout</a>
</div>

<div class="main">
    <div class="card">
        <h2>Admin Information</h2>
        <div class="admin-info">
            <p><strong>ID:</strong> <?php echo $admin['id']; ?></p>
            <p><strong>Username:</strong> <?php echo htmlspecialchars($admin['username']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($admin['email']); ?></p>
        </div>
    </div>

    <div class="card">
        <h2>Manage Products</h2>
        <p>Use the CRUD operations below to manage your products.</p>
        <div class="crud-links">
            <a href="add_product.php" class="add">➕ Add Product</a>
            <a href="manage_products.php?action=edit" class="edit">✏️ Edit Product</a>
            <a href="manage_products.php?action=delete" class="delete">🗑️ Delete Product</a>
            <a href="manage_products.php" class="view">👁️ View Products</a>
        </div>
    </div>
</div>

</body>
</html>
