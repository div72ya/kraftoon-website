<?php
session_start();
include 'db.php';

// ✅ Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please login to view your cart.");
}

$user_id = $_SESSION['user_id'];

// ✅ Fetch cart items from database and store in session
$query = "SELECT c.id, c.product_id, c.product_name, c.price, c.image, c.quantity 
          FROM cart_items c WHERE c.user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$_SESSION['cart'] = []; // Reset session cart

while ($row = $result->fetch_assoc()) {
    $_SESSION['cart'][$row['product_id']] = [
        'product_name' => $row['product_name'],
        'price' => $row['price'],
        'quantity' => $row['quantity'],
        'image' => $row['image']
    ];
}
?>

<html lang="en">
<head>
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="ccart.css">
    <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
</head>
<body>
    <nav class="navbar">
        <div>
            <img src="images/logo.jpeg" alt="Kraftoon Lab Logo" class="logo">
            <h1>Kraftoon Lab</h1>
        </div>
        <div>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="our_products.php">OUR PRODUCTS</a></li>
                <li><a href="#about-us">ABOUT US</a></li>
            </ul>
        </div>
        <div class="nav-icons">
            <div>
                <a href="cart.php"><img src="images/cart.jfif" alt="cart"></a>
                <a href="logout.php"><img src="images/logout.jfif" alt="logout"></a>
            </div>
            <div class="social-icons">
                <a href="https://wa.me/919418881900" target="_blank">
                    <img src="images/whatsaap.jpg" alt="WhatsApp">
                </a>
                <a href="https://www.instagram.com/the_kraftoon_lab?igsh=Zzcyb3RuaGY2OHRn" target="_blank">
                    <img src="images/instagram.jpg" alt="Instagram">
                </a>
            </div>
        </div> 
    </nav>

<div class="main-container">
    <div class="cart-container">
        <h1>Your Shopping Cart</h1>
        <table>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>

            <?php
            $total = 0;
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $product_id => $item) {
                    $subtotal = $item['price'] * $item['quantity'];
                    $total += $subtotal;
                    echo "<tr>
                            <td><img src='uploads/{$item['image']}' width='80'></td>
                            <td>{$item['product_name']}</td>
                            <td>₹{$item['price']}</td>
                            <td>
                                <div class='quantity-controls'>
                                    <a href='update_cart.php?action=decrease&id={$product_id}'>-</a>
                                        {$item['quantity']}
                                    <a href='update_cart.php?action=increase&id={$product_id}'>+</a>
                                </div>
                            </td>
                            <td>₹{$subtotal}</td>
                        </tr>";
                }
                echo "<tr class='grand-total-row'>
                        <td colspan='4'></td>
                        <td class='total-amount'>Grand Total: ₹$total</td>
                      </tr>";
            } else {
                echo "<tr><td colspan='6'>Your cart is empty.</td></tr>";
            }
            ?>
        </table>
        <br>
        <div class="buttons">
            <a href="our_products.php" class="continue-shopping">Continue Shopping</a>
            <a href="checkout.php" class="checkout-btn">Proceed to Checkout</a>
        </div>   
    </div>
</div>
</body>
</html>
