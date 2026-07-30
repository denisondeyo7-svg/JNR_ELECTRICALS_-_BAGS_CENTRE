<?php

include("config.php");

 
if(isset($_POST['submit'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $folder = "../dp/".$image;

    move_uploaded_file($tmp , $folder);

    //check for phone number if it exists
    $select ="SELECT * FROM customers where phone ='$phone'";

    $results3 = mysqli_query($connection,$select);

    if($results3 && mysqli_num_rows($results3)>0){
        echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>This phone number is already registered</div>";
        exit();
    

    }
    else{

        //insert into database

        $insert_my_data = "INSERT INTO customers (fname , lname , phone , password , image) 
            VALUES('$fname','$lname','$phone','$password','$image') " ;

        $results = mysqli_query($connection , $insert_my_data);

        if($results){
            

            header("Location: ../success.php");
            exit();
        }else{
            echo"Please try again";
            exit();
        }
    }
}

?>