<?php
session_start();

include("config.php");


if (!isset($_SESSION['cart'])) {

    $_SESSION['cart'] = array();

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product_id = $_POST['product_id'];

    $product_name = $_POST['product_name'];

    $product_price = $_POST['product_price'];


    // If item already exists in cart, increment quantity else we place it
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

header("Location: ../index.php");

exit();



//delete the items in cart
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    if (isset($_SESSION['cart'][$product_id])) {

        unset($_SESSION['cart'][$product_id]); 
    }
    
    header("Location: ../cart.php"); // Redirect back to the cart page
    exit();
}
?>
