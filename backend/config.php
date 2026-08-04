<?php



$host = "://infinityfree.com"; // 1. CHANGE THIS to your MySQL Hostname
$username = "if0_42538586";        // 2. Your exact account username
$password = "1290Den001";       // 3. CHANGE THIS to your revealed password
$dbname = "if0_42538586_jnr_db"

$connection = mysqli_connect($host,$username,$password,$dbname);

if(!$connection){
    die("Connection failed please try again");
}

?>