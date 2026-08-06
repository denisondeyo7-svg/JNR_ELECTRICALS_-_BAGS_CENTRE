<?php
include("backend/config.php");

$select_data = "SELECT * FROM reviews";

$results = mysqli_query($connection, $select_data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reviews</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-7.2.0-web/css/all.min.css">
</head>
<body>
    <div class="review-wrapper">
        <h2>Customer's Review</h2>

        <div class="review">
            
<?php 
    if($results && mysqli_num_rows($results)>0){
        while($row= mysqli_fetch_assoc($results)){?>




            <div class="review-card">
                
                <img src="dp/<?php echo $row['image'];?>" id="review_image" alt="Image not available at this moment">
                <div class="client_name_and_phone">
                    <p><?php echo $row['username'];?></p>
                    <p><?php echo $row['phone'];?></p>
                </div>
                <div class="client_review">
                    <p><?php echo $row['message'];?>.</p>
                </div>

            </div>
        <?php
        }
    }else{
        echo"Use the form below to a add review to appear on our board";
    }
    ?>
    

        </div>

        <div class="form_action">
            <h2>Send  your Review</h2>
            <form action="backend/add_review.php"method="post" enctype="multipart/form-data">
                <p>Drop a Review to appear on board</p>
                <div class="input">
                    <i class="fas fa-user"></i>
                    <input type="text" name="username" placeholder="Enter your username"required>
                </div>

                <div class="input">
                    <i class="fas fa-phone"></i>
                    <input type="tel" name="phone" placeholder="Enter your phone number"required>
                </div>

                <div class="input">
                    <i class="fas fa-message"></i>
                    <textarea name="message" id="message" placeholder="Enter your message here..."></textarea>
                </div>

                <div class="input">
                    <i class="fas fa-image"></i>
                    <input type="file" name="image"required>
                </div>
                <button type="submit" id="updatebtn"name="send_message"><i class="fas fa-heart"></i>     Add </button>
            </form>
        </div>
    </div>
</body>
</html>