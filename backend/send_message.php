<?php
session_start();

include("config.php");

if(!isset($_SESSION['customer_id'])){

    header("Location: ../customerlogin.html");

    exit();
}
if(isset($_POST['send_message'])){

    $customer_id=$_SESSION['customer_id'];

    $message = $_POST['message'];

    //insert data to the database

    $insert_my_data = "INSERT INTO messages (message,customer_id)

            VALUES('$message','$customer_id')";

    $results= mysqli_query($connection, $insert_my_data);

    if($results){

        header("Location: ../jnrmessages.php");

        exit();
    }
    else{
        echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>Something went wrong please try again</div> ";
    }

}






?>