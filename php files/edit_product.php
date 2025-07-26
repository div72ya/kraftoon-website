<?php
// Include the database connection
include 'db.php';

// Check if the 'id' is present in the URL (i.e., it was passed as a GET parameter)
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id']; // Get the product ID from the URL

    // Query to fetch the product details based on the product ID
    $query = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id); // Bind the 'id' as an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // If the product exists, fetch the product details
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $product_name = $product['product_name'];
        $price = $product['price'];
        $description = $product['description'];
        $category = $product['category'];
        $image = $product['image'];
    } else {
        // If no product found, display an error
        echo "Product not found.";
        exit;
    }
} else {
    // If 'id' is not set or invalid, display an error
    echo "Product ID is missing or invalid.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product page</title>
    <link rel="stylesheet" href="admin.css">
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
    <div class="outer-box">
        <div class="inner-box">
            <header class="admin-login">
            
<h1>Edit Product</h1>

<!-- Form to edit the product -->
<form action="update_product.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data" class="login-body">
   <p> <label for="product_name">Product Name:</label>
    <input type="text" name="product_name" value="<?php echo $product_name; ?>" required><br>
</p>
<p>
    <label for="price">Price:</label>
    <input type="text" name="price" value="<?php echo $price; ?>" required><br>
</p>
<p>
    <label for="description">Description:</label>
    <textarea name="description" required><?php echo $description; ?></textarea><br>
</p>
<p>
    <label for="category">Category:</label>
    <input type="text" name="category" value="<?php echo $category; ?>" required><br>
</p>
<p>
    <label for="image">Product Image:</label>
    <input type="file" name="image">   
    <img src="uploads/<?php echo $image; ?>" alt="Current Image" width="100">
</p>
    <p>
    <input type="submit" name="submit" value="Update Product">
</p>
</form>
</main>
        </div>
    </div>
</body>
</html>
