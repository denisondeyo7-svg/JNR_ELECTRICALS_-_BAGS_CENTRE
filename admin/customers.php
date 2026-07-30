
<?php
include("../backend/config.php");

$select_all  ="SELECT * FROM customers";

$results = mysqli_query($connection , $select_all);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>customers</title>
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="table-wrapper">
        <h2>Our customers</h2>

        <table>
            <thead>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Phone</th>
                <th>Action</th>
            </thead>
<?php 
    if($results && mysqli_num_rows($results)>0){
        while($row = mysqli_fetch_assoc($results)){?>
        
            <tbody>
                <td><?php echo $row['fname'];?></td>
                <td><?php echo $row['lname'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td>
                    <a href="../backend/delete_customer.php?id=<?php echo $row['id']?>">
                        <button id="delete_btn"onclick="return confirm ('Are you sure you want to delete <?php echo $row['fname'];?> from customers? ')"><i class="fas fa-user-xmark"></i>        Delete</button>
                    </a>
                </td>
            </tbody>
        <?php
        }
    }else{
        echo"No data found from the databse";
    }?>
        </table>
    </div>
</body>
</html>