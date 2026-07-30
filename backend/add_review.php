<?php

include("config.php");

if(isset($_POST['send_message'])){
    $username = $_POST['username'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    $image = $_FILES['image']['name'];

    $tmp = $_FILES['image']['tmp_name'];

    $folder = "../dp/".$image;

    move_uploaded_file($tmp , $folder);


    $insert = "INSERT INTO reviews(username,phone,message,image)
             VALUE('$username','$phone','$message','$image')";

    $result = mysqli_query($connection, $insert);

    if($result){
        header("Location: ../reviews.php");
        exit();
    }else{
        echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>Somethign went wrong...</div>";
        exit();
    }
}



?>