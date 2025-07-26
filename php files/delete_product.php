<?php
include 'db.php';  // Include the database connection

// Check if the 'id' parameter exists in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];  // Get the product ID from the URL

    // Fetch the product image from the database
    $sql = "SELECT image FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $image_path = 'uploads/' . $row['image'];  // Image file path
        
        // Delete the image file from the server
        if (file_exists($image_path)) {
            unlink($image_path);  // Delete the file from the server
        }
    }

    // SQL query to delete the product by ID
    $sql = "DELETE FROM products WHERE id = $product_id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to the product list page after deletion
        header("Location: view_products.php");  // Adjust the redirect to your product list page
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No product ID specified.";
}
?>
