<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-7.2.0-web/css/all.min.css">
</head>
<body>
    <div class="cart-container">
        <h2>My Shopping Cart</h2>
        
        <a href="shop.php"id="back2shop"><i class="fas fa-shopping-bag"></i> Continue Shopping</a>

        <?php
        // 2. Check if the cart exists 
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            $total_cart_price = 0;
            ?>
            
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    foreach ($_SESSION['cart'] as $id => $item) {
                        // Strip any currency symbols or alphabetic text to get a clean number

                        $clean_price = preg_replace('/[^0-9.]/', '', $item['price']);
                        
                        // Calculate item total safely using numeric types
                        $item_total = (float)$clean_price * (int)$item['quantity'];
                        
                        // Add to grand total
                        $total_cart_price += $item_total;
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['name']); ?></td> 
                            <td><?php echo number_format((float)$clean_price, 2); ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($item_total, 2); ?></td>
                            <td><a href="backend/deleteorders.php?id=<?php echo $id; ?>"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            
            <div class="total">
                Total: <span style="color: #007bff;">Kshs   <?php echo number_format($total_cart_price, 2); ?></span>
            </div>
            
            <div style="text-align: right; margin-top: 20px;">
                <a href="backend/checkout.php?total=<?php echo $total_cart_price; ?>">
                    <button style="background-color: #007bff; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px;">Proceed <i class="fas fa-wallet"></i></button>
                </a>
                
            </div>

        <?php 
        } else {
            
            echo "<p style='font-size: 1.1rem; color: #999;'>Your cart is currently empty.</p>";
        } 
        ?>
    </div>
</body>
</html>
