<?php
session_start();
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout Process</title>
    <link rel="stylesheet" href="checkouts.css">
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
                <li>
                    <a href="index.php">HOME</a>
                </li>
                <li>
                    <a href="our_products.php">OUR PRODUCTS</a>
                </li>
                <li>
                    <a href="#about-us">ABOUT US</a>
                </li>
            </ul>
        </div>
        <div class="nav-icons">
            <div>
                <a href="cart.php">
                    <img src="images/cart.jfif" alt="cart">
                </a>
                <a href="logout.php">
                    <img src="images/logout.jfif" alt="logout">
                </a>
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
        <div class="checkout-container">
            <h2>Checkout</h2>

            <form action="process_checkout.php" method="POST">
                <!-- Billing Details -->
                <div class="section">
                    <h3>Billing Details</h3>
                    <label for="name">Full Name</label>
                    <input type="text" name="name" id="name" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>

                    <label for="phone">Phone Number</label>
                    <input type="tel" name="phone" id="phone" required>
                </div>

                <!-- Shipping Address -->
                <div class="section">
                    <h3>Shipping Address</h3>
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" required>

                    <label for="city">City</label>
                    <input type="text" name="city" id="city" required>

                    <label for="zip">ZIP Code</label>
                    <input type="text" name="zip" id="zip" required>
                </div>

                <!-- Payment Details -->
                <div class="section">
                    <h3>Payment Details</h3>
                    <label for="card">Card Number</label>
                    <input type="text" name="card" id="card" required>

                    <label for="expiry">Expiry Date</label>
                    <input type="month" name="expiry" id="expiry" required>

                    <label for="cvv">CVV</label>
                    <input type="text" name="cvv" id="cvv" required>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="checkout-btn">Place Order</button>
            </form>
        </div>
    </div>
</body>
</html>
