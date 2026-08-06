<?php

include("config.php");


$id = $_GET['id'];


//delete query
$delete_data = "DELETE FROM reviews where id ='$id'";

$results = mysqli_query($connection,$delete_data);

if($results){
    header("Location: ../admin/testimonials.php");
    exit();
}else{
    echo"Something went wrong";
    exit();
}

?>