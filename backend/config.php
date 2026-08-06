<?php

$host = "localhost";
$username = "root";       
$password = "";      
$dbname = "jnr";


$connection = mysqli_connect($host,$username,$password,$dbname);

if(!$connection){
    die("Connection failed please try again");
}

?>
