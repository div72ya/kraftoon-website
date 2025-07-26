<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product page</title>
    <link rel="stylesheet" href="admin.css">
    <link rel="shortcut icon" href="images/logo.jpeg" type="image/x-icon">
</head>
<body>

    <?php
include 'db.php';  // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form inputs
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);

    // Handle image upload
    $image = $_FILES['image']['name'];  // Get the image name
    $image_tmp = $_FILES['image']['tmp_name'];  // Temporary file name
    $image_path = 'uploads/' . $image;  // Set the destination path for the image

    // Move the uploaded image to the "uploads" folder
    if (move_uploaded_file($image_tmp, $image_path)) {
        // Insert the product details into the database
        $sql = "INSERT INTO products (product_name, price, description, category, image) 
                VALUES ('$product_name', '$price', '$description', '$category', '$image')";

        if ($conn->query($sql) === TRUE) {
            echo "Product added successfully!";
            header("Location: admin_dashboard.php");  // Redirect to admin dashboard
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading the image.";
    }
}
?>

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
                <h1>
                   Add New Product
                </h1>
            </header>
            <main class="login-body">

                    <form action="add product.php" method="POST" enctype="multipart/form-data">
                    <p>
                        <label for="product-name">Product Name</label>
                        <input type="text" name="product_name" placeholder="Product Name" required>
                    </p>
                    <p>
                        <label for="product-price">Price (₹)</label>
                        <input type="number" name="price" placeholder="Price" step="0.01" required><br>
                    </p>
                    <p>
                        <label for="product-description">Description</label>
                        <textarea name="description" placeholder="Product Description" required></textarea><br>
                    </p>
                    <p>
                        <label for="product-category">Category</label>
                        <select name="category" required>
                        <option value="">Select a Category</option>
                        <option value="keychains">Keychains</option>
                        <option value="Wall Art">Wall Art</option>
                        <option value="Jewelry">Jewelry</option>
                        <option value="Custom Orders">Custom Orders</option>
                        </select>
                    </p>    
                    <p>
                        <label for="product-image">Upload Image</label>
                        <input type="file" name="image" required><br>
                    </p>
                    <p>
                        <input type="submit" id="submit" value="Add Product">
                    </p>
                </form>
            </main>
        </div>
    </div>
</body>
</html>