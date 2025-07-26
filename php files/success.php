<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product page</title>
    <link rel="stylesheet" href="success.css">
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
    
    <!-- Success Popup -->
<div id="successPopup" class="popup">
    <div class="popup-content">
        <div class="checkmark-circle">
            <div class="background"></div>
            <div class="checkmark draw"></div>
            </div>
        <h2>Order Placed Successfully!</h2>
        <p>Your order has been placed.</p>
        <button onclick="closePopup()">Back to Home</button>
    </div>
</div>

<script>
    function showPopup() {
        document.getElementById("successPopup").style.display = "flex";
    }

    function closePopup() {
        window.location.href = "index.php"; // Change to your homepage URL
    }

    // Trigger the popup after order placement
    window.onload = function() {
        showPopup();
    };
</script>
</body>
</html>