<?php
session_start();

include("config.php");


$username= $_POST['username'];

$password = $_POST['password'];

$select = "SELECT * FROM admin where username='$username' and  password='$password'";

$results = mysqli_query($connection, $select);

if($results && mysqli_num_rows($results)>0){
    $row = mysqli_fetch_assoc($results);

    $_SESSION['username']=$row['username'];

    header("Location: ../admin/index.php");
        
}else{
    echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>Invalid credentials </div>";
    exit();
}
?>