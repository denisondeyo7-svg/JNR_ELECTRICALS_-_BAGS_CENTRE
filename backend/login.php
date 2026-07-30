<?php
session_start();

include("config.php");

//select from database

if(isset($_POST['submit'])){

    $fname = $_POST['fname'];

    $password = $_POST['password'];

    $select="SELECT  * FROM customers where fname ='$fname'";

    $results = mysqli_query($connection,$select);

    if($results && mysqli_num_rows($results)>0){

        $row= mysqli_fetch_assoc($results);

        //password 
        if($row['password']==$password){

            $_SESSION['customer_id'] = $row['id'];

            $_SESSION['fname'] = $fname;

            header("Location: ../index.php");

            exit();
        }
        else{
            echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>You entered a wrong password </div>";

            exit();
        }
    }else{
        echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>User not found </div>";

        exit();
    }
}








?>