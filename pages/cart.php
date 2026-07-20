<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';
$user_id = $_SESSION['user_id'];

/* -----------------------------
   ADD TO CART
------------------------------ */
if (isset($_POST['add_to_cart'])) {
    $product_id = (int)$_POST['product_id'];

    $stmt = $conn->prepare("SELECT id FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);

    if ($stmt->rowCount() > 0) {
        $conn->prepare("UPDATE cart 
                        SET quantity = quantity + 1, updated_at = NOW() 
                        WHERE user_id = ? AND product_id = ?")
             ->execute([$user_id, $product_id]);
    } else {
        $conn->prepare("INSERT INTO cart (user_id, product_id, quantity, created_at, updated_at) 
                        VALUES (?, ?, 1, NOW(), NOW())")
             ->execute([$user_id, $product_id]);
    }
}

/* -----------------------------
   UPDATE QUANTITY
------------------------------ */
if (isset($_POST['update_quantity'])) {
    $cart_id = (int)$_POST['cart_id'];
    $quantity = max(1, (int)$_POST['quantity']);

    $stmt = $conn->prepare("UPDATE cart 
                            SET quantity = ?, updated_at = NOW() 
                            WHERE id = ? AND user_id = ?");
    $stmt->execute([$quantity, $cart_id, $user_id]);
}

/* -----------------------------
   REMOVE ITEM
------------------------------ */
if (isset($_POST['remove_from_cart'])) {
    $cart_id = (int)$_POST['cart_id'];

    $stmt = $conn->prepare("DELETE FROM cart WHERE id = ? AND user_id = ?");
    $stmt->execute([$cart_id, $user_id]);
}

/* -----------------------------
   FETCH CART ITEMS
------------------------------ */
$stmt = $conn->prepare("SELECT cart.id AS cart_id, products.name, products.price, cart.quantity 
                        FROM cart 
                        JOIN products ON cart.product_id = products.id 
                        WHERE cart.user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_cost = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>
    <link rel="stylesheet" href="../css/cart.css">
</head>
<body>
<div class="cart-container">
    <h2>Your Shopping Cart</h2>

    <?php if (empty($cart_items)): ?>
        <p>Your cart is empty.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($cart_items as $item): 
                $subtotal = $item['price'] * $item['quantity'];
                $total_cost += $subtotal;
            ?>
                <tr>
                    <td data-label="Product"><?= htmlspecialchars($item['name']); ?></td>
                    <td data-label="Price">$<?= number_format($item['price'], 2); ?></td>
                    <td data-label="Quantity">
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                            <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1">
                            <button type="submit" name="update_quantity">Update</button>
                        </form>
                    </td>
                    <td data-label="Subtotal">$<?= number_format($subtotal, 2); ?></td>
                    <td data-label="Actions">
                        <form method="POST" style="display:inline-block;">
                            <input type="hidden" name="cart_id" value="<?= $item['cart_id']; ?>">
                            <button type="submit" name="remove_from_cart">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

        <h3>Total: $<?= number_format($total_cost, 2); ?></h3>
    <?php endif; ?>

    <a href="../user_db.php">Continue Shopping</a>
</div>
</body>
</html>
