<?php
session_start();

include("backend/config.php");

if(!isset($_SESSION['fname'])){

    header('Location: customerlogin.html');

    exit();
}
$fname = $_SESSION['fname'];
$select ="SELECT * FROM customers where fname ='$fname'";

$results = mysqli_query($connection,$select);

if($results && mysqli_num_rows($results)>0){
    $row = mysqli_fetch_assoc($results);
}
else{
    echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>Failed to connect to the database </div>";
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-7.2.0-web/css/all.min.css">
</head>
<body>
    <div class="account_wrapper">
        <h2>Account management</h2>
        <div class="account-card-wrapper">
            <div class="account_card">
                <small id="accounttitle">My Account</small>
                <div class="container">
                    <img src="dp/<?php echo $row['image'];?>" id="dp"alt="">
                    <div class="details">
                        <small>Fname :  <?php echo $row['fname'];?></small>
                        <small>Lname :  <?php echo $row['lname'];?></small>
                        <small>Tel :  <?php echo $row['phone'];?></small>
                        <small>pass :  <?php echo $row['password'];?></small>
                    </div>
                </div>
                <div class="account-management-btns">
                    <a href="backend/update_account.php">
                        <button id="update_account"><i class="fas fa-gear"></i>     Update Account</button>
                    </a>
                
                    <a href="backend/delete_account.php">
                        <button id="delete_account"onclick="return confirm('Are you sure you want to delete this account')"><i class="fas fa-trash"></i>        Delete Account</button>
                    </a>
                </div>


            </div>
        </div>
    </div>
</body>
</html>