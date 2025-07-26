<?php
session_start();
include 'db.php';  // Include database connection

// Fetch unique categories for filtering
$category_query = "SELECT DISTINCT category FROM products";
$category_result = $conn->query($category_query);

// Fetch all products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Products</title>
    <link rel="stylesheet" href="our products.css">  <!-- Link your CSS file -->
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

    <div class="category-container">
        <?php
        while ($cat = $category_result->fetch_assoc()) {
            echo "<span class='category-item' onclick='filterProducts(\"".$cat['category']."\")'>{$cat['category']}</span>";
        }
        ?>
    </div>

    
    <!-- Product Grid -->
     <div class="outer-product-container">
    <div class="product-container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="product-card" data-category="<?php echo $row['category']; ?>">
                    <img src="uploads/<?php echo $row['image']; ?>" alt="<?php echo $row['product_name']; ?>">
                    <button class="add-to-cart" onclick="addToCart(<?php echo $row['id']; ?>)">+</button>
                    <h2><?php echo $row['product_name']; ?></h2>
                    <p><?php echo $row['description']; ?></p>
                    <p><strong>₹<?php echo $row['price']; ?></strong></p>
                </div>
                <?php
            }
        } else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>

    
    <script>
        function filterProducts(category) {
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                if (category === "All" || product.getAttribute('data-category') === category) {
                    product.style.display = "block";
                } else {
                    product.style.display = "none";
                }
            });
        }

        function addToCart(productId) {
            window.location.href = "add_to_cart.php?product_id=" + productId;
        }
    </script>

<script>
    function addToCart(productId) {
        // AJAX request to add product to cart
        fetch('add_to_cart.php?product_id=' + productId)
            .then(response => response.json())
            .then(data => {
                // Show the popup message
                let popup = document.getElementById("popupMessage");
                popup.innerHTML = data.message;
                popup.classList.add("show");

                // Hide popup after 2 seconds
                setTimeout(() => {
                    popup.classList.remove("show");
                }, 2000);
            })
            .catch(error => console.error('Error:', error));
    }
</script>

<!-- Popup Message -->
<div id="popupMessage" class="popup"></div>

    <footer>
    <div class="footer-full">
        <div class="container">
            <div class="row">
                <div class="footer-content-1">
                    <h2 class="footer-title-1">
                        USEFUL LINKS:-
                    </h2>
                    <div class="footer-menu-block">
                        <ul>
                            <li class="footer-menu-item">
                                <a href="index.php" title="home">HOME</a>
                            </li>
                            <li class="footer-menu-item">
                                <a href="our_products.php" title="our products">OUR PRODUCTS</a>
                            </li>
                            <li class="footer-menu-item">
                                <a href="mailto:cthegenz@gmail.com">CONTACT</a>
                            </li>
                            <li class="footer-menu-item">
                                <a href="#about-us" title="about us">ABOUT US</a>
                            </li>
                        </ul>
                    </div>
                </div>
                    <div class="footer-content-3">
                        <div>
                            <div class="footer-block-content">
                                <h2 class="footer-title-2">
                                    NEED HELP?
                                </h2>
                                <P>
                                    We're available at:-<br>
                                    (9 AM -7 PM) India Time
                                </P>
                                <p>
                                    Phone : +91 8988554002
                                </p>
                                <p>
                                    Email : abhinav@gmail.com
                                </p>
                            </div>
                        </div>
                    </div>
                        <div class="footer-content-4">
                            <h2 class="footer-title-4">
                                JOIN US
                            </h2>
                            <div class="footer-block">
                                <div class="footer-block-content">
                                    <div class="social-icons">
                                        <a href="https://wa.me/919418881900" target="_blank">
                                            <img src="images/whatsaap.jpg" alt="WhatsApp">
                                        </a>
                                        <a href="https://www.instagram.com/the_kraftoon_lab?igsh=Zzcyb3RuaGY2OHRn" target="_blank">
                                            <img src="images/instagram.jpg" alt="Instagram">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        <div class="footer-section">
            <div class="footer-bottom">
                <div class="container">
                    <div class="footer-bottom__innerrow">
                        <div class="footer-index-1">
                            © Copyright 2025. All Right Reserved
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
