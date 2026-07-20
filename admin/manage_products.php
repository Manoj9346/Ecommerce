<?php
include '../includes/db.php';
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

$stmt = $conn->query("SELECT * FROM products ORDER BY id DESC");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle status messages
$msg = "";
if (isset($_GET['msg'])) {
    switch ($_GET['msg']) {
        case "updated": $msg = "✅ Product updated successfully!"; break;
        case "deleted": $msg = "🗑️ Product deleted successfully!"; break;
        case "error":   $msg = "❌ Something went wrong. Please try again."; break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <link rel="stylesheet" href="../css/manage_products.css">
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
        <h2>Manage Products</h2>

        <?php if ($msg): ?>
            <div class="msg <?= ($_GET['msg'] == 'error') ? 'error' : 'success' ?>">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <div class="top-links">
            <a href="add_product.php">➕ Add Product</a>
            <a href="dashboard.php">⬅ Back to Dashboard</a>
        </div>

        <?php if (count($products) > 0): ?>
            <table>
                <tr>
                    <th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th><th>Actions</th>
                </tr>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($p['id']) ?></td>
                        <td><?= htmlspecialchars($p['name']) ?></td>
                        <td>$<?= htmlspecialchars($p['price']) ?></td>
                        <td><?= htmlspecialchars($p['description']) ?></td>
                        <td>
                            <?php if (!empty($p['image']) && file_exists("../images/" . $p['image'])): ?>
                                <img src="../images/<?= htmlspecialchars($p['image']) ?>" alt="">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td class="actions">
                            <a href="edit_product.php?id=<?= $p['id'] ?>" class="edit">✏️ Edit</a>
                            <a href="delete_product.php?id=<?= $p['id'] ?>" class="delete" onclick="return confirm('Delete this product?');">🗑️ Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p class="no-products">No products found. <a href="add_product.php">Add one now</a>.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
