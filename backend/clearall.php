<?php

session_start();

// Overwrite the cart session with an empty array to wipe everything out
$_SESSION['cart'] = array();

// Redirect back up one folder to your main cart page
header("Location: ../cart.php");

exit();
?>
