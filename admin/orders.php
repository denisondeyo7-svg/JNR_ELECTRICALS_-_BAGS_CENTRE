<?php

session_start();

include("../backend/config.php"); 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order Management</title>
    <link rel="stylesheet" href="style.css"> <!-- Reuses your shop stylesheet -->
    <link rel="stylesheet" href="fontawesome-free-7.2.0-web/css/all.min.css">
    <style>
        .admin-container {
            max-width: 1100px;
            margin: 30px auto;
            padding: 20px;
            font-family: sans-serif;
        }
        .admin-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .admin-table th, .admin-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .admin-table th {
            background-color: #007bff;
            color: white;
        }
        .items-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }
        .items-list li {
            font-size: 0.9rem;
            color: #333;
            border-bottom: 1px dashed #eee;
            padding: 4px 0;
        }
        .items-list li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <h2 style="color: #007bff; border-bottom: 2px solid #007bff; padding-bottom: 10px;">
            <i class="fas fa-user-shield"></i> Customer Orders
        </h2>

        <?php
       
        $query = "SELECT 
    o.order_id, 
    o.fname, 
    o.lname, 
    o.total_amount, 
    o.order_status, 
    o.created_at,
    oi.product_name,
    oi.quantity
FROM orders o
LEFT JOIN order_items oi ON o.order_id = oi.order_id
ORDER BY o.order_id DESC";


        $results = mysqli_query($connection, $query);

        if ($results && mysqli_num_rows($results) > 0) {
            ?>
            <table class="admin-table">
                <thead>
                    <tr>
                       
                        <th>Customer Name</th>
                        <th>Purchased Items</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date Ordered</th>
                        <th>Status</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
    <?php while ($row = mysqli_fetch_assoc($results)) { ?>
        <tr>
            <!-- 1. Display Order ID -->
            
            
            <!-- 2. Display Full Name -->
            <td><?php echo htmlspecialchars($row['fname'] . ' ' . $row['lname']); ?></td>
            
            <!-- 3. Display Single Product Name -->
            <td><?php echo htmlspecialchars($row['product_name']); ?></td>
            
            <!-- 4. Display Product Quantity -->
            <td><?php echo $row['quantity']; ?></td>
            
            <!-- 5. Display Total Price for the Order -->
            <td>$<?php echo number_format($row['total_amount'], 2); ?></td>
            
            <!-- 6. Display Date -->
            <td><?php echo $row['created_at']; ?></td>
            
            <!-- 7. Display Status -->
            <td><?php echo htmlspecialchars($row['order_status']); ?></td>
            <td>
                <a href="../backend/delete_orders.php?id=<?php echo $row['order_id'];?>">
                    <button id="delete_btn">Delete</button>
                </a>
            </td>
        </tr>
    <?php } ?>
</tbody>

            </table>
            <?php
        } else {
            echo "<p style='margin-top: 20px; color: #999;'>No customer orders found in the database.</p>";
        }
        ?>
    </div>
</body>
</html>
