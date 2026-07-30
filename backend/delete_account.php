<?php
session_start();
include("config.php");


if(!isset($_SESSION['fname'])){

    header('Location: ../customerlogin.html');

    exit();
}
$my_fname = $_SESSION['fname'];

$Delete= "DELETE FROM customers where fname ='$my_fname'";

$results = mysqli_query($connection, $Delete);

if($results){
    echo"<div style='background: #fff;text-align:center;box-shadow:2px 10px 22px #999;border-radius:5px;padding:12px ;color: #f40;font-family: Segoe UI;'>Accounted deleted successfully </div> <br>";
    echo"<div> 
                <a href='../customerregistration.html'>
                    <button onclick='history.back()'style='background: rgb(37, 148, 46);padding:12px;color: #fff;
                    border: none;font-family: Segoe UI;'>
                    Back to Registration
                </button>
                </a>
             </div>";
    exit();
}else{
    echo"Something went wrong...";
}

?>