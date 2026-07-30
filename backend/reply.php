<?php

include("config.php");

if(isset($_POST['sendreply'])){
    $reply = $_POST['reply'];

    $insert_to_database="INSERT INTO replies (reply) VALUES('$reply')";

    $results=mysqli_query($connection, $insert_to_database);

    if($results){
        
        header("Location: ../admin/messages.php");
        exit();

    }else{
        echo"Something went wrong...";
    }
}
?>