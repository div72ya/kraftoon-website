<?php
include 'db.php';  // Include database connection

// Query to fetch all products from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Products</title>
    <link rel="stylesheet" href="productt.css">
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
                <li>
                    <a href="admin_dashboard.php">ADMIN</a>
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

    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="add product.php">Add Product</a></li>
            <li><a href="view_products.php">Products</a></li>
            <li><a href="admin logout.php">Admin Logout</a></li>
        </ul>
    </div>

    <div class="outer-container">
        <div class="container">
            <h1>Product List</h1>

            <!-- Start of the Table -->
            <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Actions</th> <!-- Added column for Edit/Delete -->
                </tr>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>" . $row['price'] . "</td>";
                        echo "<td>" . $row['description'] . "</td>";
                        echo "<td>" . $row['category'] . "</td>";
                        echo "<td><img src='uploads/" . $row['image'] . "' width='100'></td>";
                        echo "<td>
                                <a href='edit_product.php?id=" . $row['id'] . "'>Edit</a> | 
                                <a href='delete_product.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No products found.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>
