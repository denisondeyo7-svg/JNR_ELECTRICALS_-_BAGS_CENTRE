<?php
include("config.php");

$update = "UPDATE  replies SET status='Read' ";

$results = mysqli_query($connection, $update);

if($results){
    header("Location: ../jnrmessages.php");
    exit();

}else{
    
    echo"something went wrong";
}

?>