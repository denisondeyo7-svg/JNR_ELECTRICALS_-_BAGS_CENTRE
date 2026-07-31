<?php


include("config.php");

$id = $_GET['id'];

$delete ="DELETE FROM orders where order_id ='$id'";
$result = mysqli_query($connection, $delete);

if($result){
    header("Location: ../admin/orders.php");
    exit();

}else{
    echo"Please try again";
}
?>