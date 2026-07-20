<?php
include '../includes/db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add_product'])) {
    $name = trim($_POST['name']);
    $price = $_POST['price'];
    $description = $_POST['description'];

    $image = $_FILES['image']['name'];
    $target = "../images/" . basename($image);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
        if ($stmt->execute([$name, $price, $description, $image])) {
            $success = "✅ Product added successfully!";
        } else {
            $error = "❌ Database error.";
        }
    } else {
        $error = "❌ Failed to upload image.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/add_product.css">
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
    <div>
        <a href="dashboard.php">Dashboard</a>
        <a href="logout.php">Logout</a>
    </div>
</header>

<div class="sidebar">
    <a href="dashboard.php">🏠 Dashboard</a>
    <a href="add_product.php">➕ Add Product</a>
    <a href="manage_products.php">📦 Manage Products</a>
    <a href="logout.php" class="logout">🚪 Logout</a>
</div>

<div class="main">
    <div class="card">
        <h2>Add Product</h2>
        <?php if (!empty($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Product Name" required>
            <input type="number" step="0.01" name="price" placeholder="Price" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input type="file" name="image" required>
            <button type="submit" name="add_product">Add Product</button>
        </form>

        <div class="back-link">
            <p><a href="manage_products.php">⬅ Back to Manage Products</a></p>
        </div>
    </div>
</div>

</body>
</html>
