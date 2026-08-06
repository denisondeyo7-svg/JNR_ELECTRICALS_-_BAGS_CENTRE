<?php
session_start();

include("../backend/config.php");

if(!isset($_SESSION['username'])){
    header("Location: adminlogin.html");

    exit();
}
//messages
$select ="SELECT count(*) as total_messages FROM messages ";

$results = mysqli_query($connection, $select);

$total_messages = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $total_messages=$row['total_messages'];

}
//admins
$select ="SELECT count(*) as admins FROM admin where role='Admin' ";

$results = mysqli_query($connection, $select);

$admins = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $admins=$row['admins'];

}

//products
$select ="SELECT count(*) as total_products FROM products ";

$results = mysqli_query($connection, $select);

$total_products= 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $total_products=$row['total_products'];

}

//electricals 
$select ="SELECT count(*) as electrical_products FROM products where product_category='Electricals'";

$results = mysqli_query($connection, $select);

$electrical_products= 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $electrical_products=$row['electrical_products'];

}

//bags

$select ="SELECT count(*) as bags_products FROM products where product_category='bags'";

$results = mysqli_query($connection, $select);

$bags_products= 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $bags_products=$row['bags_products'];

}


//registered customers
$select ="SELECT count(*) as total_customers FROM customers ";

$results = mysqli_query($connection, $select);

$total_customers = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $total_customers=$row['total_customers'];

}
//testimonials
$review ="SELECT count(*) as testimonials FROM reviews ";

$results = mysqli_query($connection, $review);

$testimonials = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $testimonials=$row['testimonials'];

}

//complete oders

$my_orders="SELECT count(*) as complete_orders FROM orders where order_status = 'Complete'";

$results = mysqli_query($connection, $my_orders);

$complete_orders = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $complete_orders=$row['complete_orders'];

}

//pending oders

$my_orders="SELECT count(*) as pending_orders FROM orders where order_status = 'pending'";

$results = mysqli_query($connection, $my_orders);

$pending_orders = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $pending_orders=$row['pending_orders'];

}

//sales made

$my_orders="SELECT count(total_amount) as total_sales FROM orders where order_status = 'pending'";

$results = mysqli_query($connection, $my_orders);

$total_sales = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $total_sales=$row['total_sales'];

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="admin-wrapper">
        <div class="nav">
           <a href="index.php"><i class="fas fa-shop"></i>   Dashboard</a>
           <a href="products.php"><i class="fas fa-shopping-cart"></i>   Products</a>
           <a href="orders.php"><i class="fas fa-car"></i>   Orders</a>
           <a href="messages.php"><i class="fas fa-bell"></i>   Messages   <sup id="notification">   <?php echo $total_messages ?></sup></a>
           <a href="customers.php"><i class="fas fa-users"></i>   Customers</a>
           <a href=""><i class="fas fa-credit-card"></i>   Payments</a>
           <a href="testimonials.php"><i class="fas fa-star"></i>   Testimonials    <sup id="notification">   <?php echo $testimonials ?></sup></a>
           <a href="../index.php"><i class="fas fa-users"></i>   Clients page</a>
           <a href="settings.php"><i class="fas fa-cog"></i>   Account Settings</a>
        </div>

        <div class="hero-wrapper">
            <div class="hero-content">

                <div class="welcome">
                    <div class="welcome-box">
                        <p>Hello <span style='color: #007bff;font-weight:550;font-size:20px;'><?php echo $_SESSION['username'];?></span>   !    Welcome back and take control of everything , let's get started.</p>
                    </div>
                </div>
                
                <div class="content">
                    <div class="box">
                        <div class="top">
                            <p>Admins</p>
                            <i class="fas fa-shield"></i>
                        </div>
                        <h4><?php echo $admins;?><h4>
                    </div>
                    
                    <div class="box">
                        <div class="top">
                            <p> Customers</p>
                            <i class="fas fa-users"></i>
                        </div>
                        <h4><?php echo $total_customers;?><h4>
                    </div>

                    <div class="box">
                        <div class="top">
                            <p> Products</p>
                            <i class="fas fa-warehouse"></i>
                        </div>
                        <h4><?php echo $total_products;?><h4>
                    </div>

                    <div class="box">
                        <div class="top">
                            <p>Electricals</p>
                            <i class="fas fa-plug"></i>
                        </div>
                        <h4><?php echo $electrical_products;?><h4>
                    </div>

                    <div class="box">
                        <div class="top">
                            <p> JNR Bags</p>
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h4><?php echo $bags_products;?><h4>
                    </div>
                    
                    <div class="box">
                        <div class="top">
                            <p> Pending orders</p>
                            <i class="fas fa-wifi"></i>
                        </div>
                        <h4><?php echo $pending_orders;?><h4>
                    </div>

                    <div class="box">
                        <div class="top">
                            <p> Complete orders</p>
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h4><?php echo $complete_orders;?><h4>
                    </div>

                    <div class="box">
                        <div class="top">
                            <p> Incomings</p>
                            <i class="fas fa-message"></i>
                        </div>
                        <h4><?php echo $total_messages;?><h4>
                    </div>
                    
                    <div class="box">
                        <div class="top">
                            <p> Testimonials</p>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4><?php echo $testimonials;?><h4>
                    </div>
                    
                    <div class="box">
                        <div class="top">
                            <p> Sales made</p>
                            <i class="fas fa-hand-holding-dollar"></i>
                        </div>
                        <h4>Ksh: <?php echo $total_sales;?><h4>
                    </div>

                    


                </div>

            </div>
        </div>

    </section>
</body>
</html>