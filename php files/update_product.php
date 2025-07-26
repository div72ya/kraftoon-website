<?php
include 'db.php'; // Include database connection

if (isset($_POST['submit'])) {
    // Get form data (product details)
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    
    // Get the product ID from the URL
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        die("Error: Product ID is missing or invalid.");
    }

    // Handle file upload
    if (!empty($_FILES['image']['name'])) {
        // Get the image file name
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        
        // Move the uploaded image to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            // Update the database including the new image
            $query = "UPDATE products SET product_name='$product_name', price='$price', description='$description', category='$category', image='$image' WHERE id=$id";
        } else {
            echo "Sorry, there was an error uploading your image.";
            exit;
        }
    } else {
        // If no new image is uploaded, update without changing the image field
        $query = "UPDATE products SET product_name='$product_name', price='$price', description='$description', category='$category' WHERE id=$id";
    }

    // Execute the query
    if ($conn->query($query) === TRUE) {
        echo "Product updated successfully.";
        // Redirect to view_products.php after updating
        header("Location: view_products.php");
        exit();
    } else {
        echo "Error updating product: " . $conn->error;
    }
}
?>
