<?php
session_start();
include("config.php");

if (!isset($_SESSION['customer_id'])) {
    header("Location: customerlogin.html");
    exit();
}

if (!isset($_GET['total']) || empty($_SESSION['cart'])) {
    header("Location: ../cart.php");
    exit();
}

$customer_id = (int)$_SESSION['customer_id'];
$grand_total = (float)$_GET['total'];

// Fetch the customer's name from the customers table using their ID
$name_query = "SELECT fname, lname FROM customers WHERE id = ?";
$name_stmt = mysqli_prepare($connection, $name_query);

$customer_fname = "Guest";
$customer_lname = "Customer";

if ($name_stmt) {
    mysqli_stmt_bind_param($name_stmt, "i", $customer_id);
    mysqli_stmt_execute($name_stmt);
    $name_result = mysqli_stmt_get_result($name_stmt);
    
    if ($row = mysqli_fetch_assoc($name_result)) {
        $customer_fname = $row['fname'];
        $customer_lname = $row['lname'];
    }
    mysqli_stmt_close($name_stmt);
}

// Insert the complete main order into the orders table
$order_query = "INSERT INTO orders (customer_id, fname, lname, total_amount) VALUES (?, ?, ?, ?)";
$order_stmt = mysqli_prepare($connection, $order_query);

if ($order_stmt) {
    mysqli_stmt_bind_param($order_stmt, "issd", $customer_id, $customer_fname, $customer_lname, $grand_total);
    
    if (mysqli_stmt_execute($order_stmt)) {
        // Grab the auto-incremented order_id generated for this specific purchase
        $new_order_id = mysqli_insert_id($connection);
        
        // Prepare the statement to insert each item from the cart into order_items
        $item_query = "INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
        $item_stmt = mysqli_prepare($connection, $item_query);
        
        if ($item_stmt) {
            // Loop through each item in the session cart and save it to database
            foreach ($_SESSION['cart'] as $pid => $item) {
                $p_name = $item['name'];
                $p_qty = (int)$item['quantity'];
                // Clean the price string to numeric float format
                $p_price = (float)preg_replace('/[^0-9.]/', '', $item['price']);
                
                mysqli_stmt_bind_param($item_stmt, "iisis", $new_order_id, $pid, $p_name, $p_qty, $p_price);
                mysqli_stmt_execute($item_stmt);
            }
            mysqli_stmt_close($item_stmt);
        }

        // Success! Clear the cart session
        $_SESSION['cart'] = array();
        
        // Alert user and redirect back to index.php
        echo "<script>
                alert('Payment Successful! Thank you, " . htmlspecialchars($customer_fname) . ". Your order has been placed.');
                window.location.href = '../index.php';
              </script>";
    } else {
        echo "Database error: Could not save the order.";
    }
    mysqli_stmt_close($order_stmt);
} else {
    echo "Order query preparation failed.";
}
?>
