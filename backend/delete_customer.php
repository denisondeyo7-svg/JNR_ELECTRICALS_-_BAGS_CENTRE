<?php

include("config.php");

$id= $_GET['id'];

$delete = "DELETE FROM customers WHERE id = '$id'";

$results = mysqli_query($connection, $delete);

if($results){

    header("Location: ../admin/customers.php");
    exit();

}else{
    echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>Something went wrong</div>";
    exit();
}


?>