<?php
include("../backend/config.php");

$select_data = "SELECT * FROM reviews";

$results = mysqli_query($connection, $select_data);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer's Reviews</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
</head>
<body>
    <div class="review_wrapper">
        <h2>Reviews from clients</h2>

        <div class="review">
            
<?php 
    if($results && mysqli_num_rows($results)>0){
        while($row= mysqli_fetch_assoc($results)){?>




            <div class="review-card">
                
                <img src="../dp/<?php echo $row['image'];?>" id="review_image" alt="Image not available at this moment">
                <div class="client_name_and_phone">
                    <p><?php echo $row['username'];?></p>
                    <p><?php echo $row['phone'];?></p>
                </div>
                <div class="client_review">
                    <p><?php echo $row['message'];?>.</p>
                </div>
                <a href="../backend/delete_review.php?id=<?php echo $row['id'];?>"><i class="fa-regular fa-user"></i>   Delete</a>
            </div>
        <?php
        }
    }else{
        echo"No data available at this moment";
    }
    ?>
    

        </div>

        
    </div>
</body>
</html>