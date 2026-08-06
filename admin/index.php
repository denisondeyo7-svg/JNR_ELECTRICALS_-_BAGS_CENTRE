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

//oders

$my_orders="SELECT count(*) as total_orders FROM orders ";

$results = mysqli_query($connection, $my_orders);

$total_orders = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $total_orders=$row['total_orders'];

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
           <a href="settings.php"><i class="fas fa-cog"></i>   Settings</a>
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
                            <i class="fas fa-cog"></i>
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
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <h4><?php echo $total_products;?><h4>
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
                            <p> Total orders</p>
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h4><?php echo $total_orders;?><h4>
                    </div>


                    <div class="box">
                        <div class="top">
                            <p> Testimonials</p>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4><?php echo $testimonials;?><h4>
                    </div>


                    


                </div>

            </div>
        </div>

    </section>
</body>
</html>