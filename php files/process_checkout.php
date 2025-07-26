<?php
ob_start();
session_start();
include 'db.php';

// ✅ Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Please log in before placing an order.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        die("Your cart is empty. Please add items before checkout.");
    }

    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $card = $_POST['card'];
    $expiry = $_POST['expiry'];
    $cvv = $_POST['cvv'];
    $order_date = date("Y-m-d H:i:s");

    // ✅ Insert into orders table with `user_id`
    $query = "INSERT INTO orders (user_id, name, email, phone, address, city, zip, card_number, expiry_date, cvv, order_date) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssssssss", $user_id, $name, $email, $phone, $address, $city, $zip, $card, $expiry, $cvv, $order_date);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        $stmt->close();

        // ✅ Insert cart items into `order_items`
        $item_query = "INSERT INTO order_items (order_id, product_id, product_name, price, quantity, total_price) 
                       VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($item_query);

        foreach ($_SESSION['cart'] as $product_id => $item) {
            $product_name = $item['product_name'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $total_price = $price * $quantity;

            $stmt->bind_param("iisddi", $order_id, $product_id, $product_name, $price, $quantity, $total_price);
            $stmt->execute();
        }
        $stmt->close();

        // ✅ Clear cart and redirect
        unset($_SESSION['cart']);
        header("Location: success.php");
        exit();
    } else {
        die("Error: " . $conn->error);
    }
}
$conn->close();
ob_end_flush();
?>
