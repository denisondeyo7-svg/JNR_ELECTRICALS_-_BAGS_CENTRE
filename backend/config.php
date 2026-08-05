<?php



$host = "sql208.infinityfree.com";
$username = "if0_42538586";       
$password = "1290Den001";      
$dbname = "if0_42538586_jnr_db";

$connection = mysqli_connect($host,$username,$password,$dbname);

if(!$connection){
    die("Connection failed please try again");
}

?>
