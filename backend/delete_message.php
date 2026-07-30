<?php

include("config.php");

$my_id = $_GET['id'];

$delete_item ="DELETE FROM messages where id ='$my_id'";

$results =mysqli_query($connection, $delete_item);

if ($results){
    header("Location: ../admin/messages.php");
}
else{
    echo"Something went wrong..try again!";
}


//replies
$id = $_GET['id'];

$delete_items ="DELETE FROM replies where id ='$id'";

$results1 =mysqli_query($connection, $delete_items);

if ($results1){
    header("Location: ../admin/messages.php");
}
else{
    echo"Something went wrong..try again!";
}

?>
