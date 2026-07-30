<?php
include("../backend/config.php");

$seletct ="SELECT * FROM admin";
$results = mysqli_query($connection,$seletct);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin settings</title>
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="card-wrapper">
        <h2>Settings</h2>

        <div class="admin-card-wrapper">
            <div class="admin-card">
                <div class="name">
                    <a href="../backend/update.php">Update</a>
                    <p>Denis</p>
                    <a href="index.php">
                        <button id='exitbtn'><i class="fas fa-sign-out-alt"></i>Exit</button>
                    </a>
                </div>
            </div>

        </div>
    </div>
</body>
</html>