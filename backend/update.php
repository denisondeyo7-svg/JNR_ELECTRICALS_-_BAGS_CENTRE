
<?php
session_start();
include("config.php");

$username= $_SESSION['username'];

$select ="SELECT * FROM admin where username='$username'";

$results = mysqli_query($connection,$select);

if($results && mysqli_num_rows($results)>0){
    $row = mysqli_fetch_assoc($results);
}
else{
    echo"Failed to connect to the database";
    exit();
}



if(isset($_POST['update_account'])){
    $username = $_POST['username'];
    
    $password = $_POST['password'];

    //update the  database

    $update_my_data = "UPDATE admin SET username='$username', password='$password' 
   
                        where username ='$username'" ;

    $results = mysqli_query($connection , $update_my_data);

    if($results){
        

        header("Location: ../admin/index.php");
        exit();
    }else{
        echo"Please try again";
        exit();
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update user</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
</head>
<body>
    <div class="form_action" >
        <h2>Account management</h2>
        <form action=""method="post"enctype="multipart/form-data">
            <p>Update account</p>
            <div class="input">
                <i class="fas fa-user"></i>
                <input type="text" name="username" value="<?php echo $row['username'];?>"required>
            </div>

            <div class="input">
                <i class="fas fa-key"></i>
                <input type="password" name="password"  value="<?php echo $row['password'];?>"required>
            </div>

            <button id="updatebtn" type="submit" name="update_account"><i class="fas fa-pen"></i>     Commit Changes</button>
        </form>
    </div>
</body>
</html>