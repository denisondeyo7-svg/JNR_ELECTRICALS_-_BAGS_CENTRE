<?php
// Start session to store cart data across page reloads
session_start();

// Include your database configuration if you need to query database later
include("config.php");

// Initialize the cart session array if it doesn't exist yet
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Check if the form's Add to Cart button was actually clicked via POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // If item already exists in cart, increment quantity. Otherwise, create it.
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity']++;
    } else {
        $_SESSION['cart'][$product_id] = [
            'name' => $product_name,
            'price' => $product_price,
            'quantity' => 1
        ];
    }
}

// Redirect back to your shop file instantly so the page refreshes cleanly
// Change 'shop.php' to your actual frontend file name (like index.php) if different
header("Location: ../shop.php");
exit();
?>
