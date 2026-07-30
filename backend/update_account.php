
<?php
session_start();

include("config.php");

if(!isset($_SESSION['fname'])){

    header('Location: ../customerlogin.html');

    exit();
}
$my_fname = $_SESSION['fname'];
$select ="SELECT * FROM customers where fname ='$my_fname'";

$results = mysqli_query($connection,$select);

if($results && mysqli_num_rows($results)>0){
    $row = mysqli_fetch_assoc($results);
}
else{
    echo"Failed to connect to the database";
    exit();
}



if(isset($_POST['update_account'])){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    $folder = "../dp/".$image;

    move_uploaded_file($tmp , $folder);

    //insert into database

    $update_my_data = "UPDATE customers SET fname='$fname' , lname='$lname' , 
                    phone='$phone', password='$password' , image='$image'
                        where fname ='$my_fname'" ;

    $results = mysqli_query($connection , $update_my_data);

    if($results){
        

        header("Location: ../index.php");
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
                <input type="text" name="fname" value="<?php echo $row['fname'];?>"placeholder="Enter your first name"required>
            </div>

            <div class="input">
                <i class="fas fa-user"></i>
                <input type="text" name="lname" value="<?php echo $row['lname'];?>" placeholder="Enter your last name"required>
            </div>

            <div class="input">
                <i class="fas fa-phone"></i>
                <input type="tel" name="phone"  value="<?php echo $row['phone'];?>"placeholder="Enter your phone number"required>
            </div>

            <div class="input">
                <i class="fas fa-key"></i>
                <input type="password" name="password"  value="<?php echo $row['password'];?>"required>
            </div>

            <div class="input">
                <i class="fas fa-image"></i>
                <input type="file" name="image" value="<?php echo $row['image'];?>" id="image_dp"required>
            </div>
            <button id="updatebtn" type="submit" name="update_account"><i class="fas fa-pen"></i>     Commit Changes</button>
        </form>
    </div>
</body>
</html>