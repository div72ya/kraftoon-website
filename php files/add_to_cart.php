<?php
session_start();
include 'db.php';  

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Please login first."]);
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($product_id <= 0) {
    echo json_encode(["status" => "error", "message" => "Invalid product ID."]);
    exit;
}

// Fetch product details
$stmt = $conn->prepare("SELECT id, product_name, price, image FROM products WHERE id = ?");
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    echo json_encode(["status" => "error", "message" => "Product not found."]);
    exit;
}

// Check if product is already in the cart
$check_stmt = $conn->prepare("SELECT * FROM cart_items WHERE user_id = ? AND product_id = ?");
$check_stmt->bind_param("ii", $user_id, $product_id);
$check_stmt->execute();
$check_result = $check_stmt->get_result();
$check_stmt->close();

if ($check_result->num_rows > 0) {
    // If exists, increase quantity
    $update_stmt = $conn->prepare("UPDATE cart_items SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
    $update_stmt->bind_param("ii", $user_id, $product_id);
    $update_stmt->execute();
    $update_stmt->close();
} else {
    // Insert new item into the cart
    $insert_stmt = $conn->prepare("INSERT INTO cart_items (user_id, product_id, product_name, price, image, quantity) VALUES (?, ?, ?, ?, ?, 1)");
    $insert_stmt->bind_param("iisss", $user_id, $product['id'], $product['product_name'], $product['price'], $product['image']);
    $insert_stmt->execute();
    $insert_stmt->close();
}

echo json_encode(["status" => "success", "message" => "Item added to cart"]);
?>
