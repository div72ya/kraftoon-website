<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($product_id <= 0) {
    die("Invalid request.");
}

if ($action == "increase") {
    $stmt = $conn->prepare("UPDATE cart_items SET quantity = quantity + 1 WHERE user_id = ? AND product_id = ?");
} elseif ($action == "decrease") {
    $stmt = $conn->prepare("UPDATE cart_items SET quantity = GREATEST(quantity - 1, 1) WHERE user_id = ? AND product_id = ?");
}

if (isset($stmt)) {
    $stmt->bind_param("ii", $user_id, $product_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: cart.php");
?>
