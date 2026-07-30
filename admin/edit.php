<?php

include("../backend/config.php");

$my_id = $_GET['id'];

$select_all= "SELECT * FROM replies where id ='$my_id'";

$results = mysqli_query($connection, $select_all);

mysqli_num_rows($results)>0;

$row = mysqli_fetch_assoc($results);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>messages</title>
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-wrapper">
        <form action="../backend/edit_reply.php?id=<?php echo $row['id'];?>" method="post">
            <p>Update</p>

            <div class="input">
                <i class="fas fa-message"></i>
                <textarea name="reply" id="reply" placeholder="Write message here "required>
                    <?php echo $row['reply'];?>
                </textarea>
            </div>

            <button type="submit" name="edit"id="login_admin"><i class="fas fa-reply"></i>     Save</button>
        </form>
    </div>
</body>
</html>