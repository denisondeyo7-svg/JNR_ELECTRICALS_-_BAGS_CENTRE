<?php 

include("backend/config.php"); 

// Avatar for admin username

$first_letter = strtoupper(substr("DENIS", 0, 2)); 

$select_messages = "SELECT  *,
                    customers.fname,
                    customers.lname,
                    customers.phone,
                    customers.image,
                    messages.message

                    from customers 

                    JOIN messages ON 
                    customers.id = messages.customer_id "; 

$results = mysqli_query($connection, $select_messages); 
?> 

<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Messages</title> 
    <link rel="stylesheet" href="fontawesome-free-7.2.0-web/css/all.min.css"> 
    <link rel="stylesheet" href="style.css"> 
</head> 
<body> 
<div class="message-container"> 
    <h2>Messages</h2> 
    <div class="message-box-wrapper"> 

        <a href="addmessage.html"> 
            <button id="addmessagebtn"><i class="fas fa-paper-plane"></i> Send Message</button> 
        </a> 
        
        <?php if($results && mysqli_num_rows($results) > 0){ 
            while($row = mysqli_fetch_assoc($results)){ ?> 
                <div class="message-box"> 
                    <div class="profile_details"> 
                        
                        <img src="dp/<?php echo $row['image']; ?>" id="user_avatar" alt=""> 
                        <div class="names_number"> 
                            <small><?php echo $row['fname']; ?></small> 
                            <small><?php echo $row['phone']; ?></small> 
                        </div> 
                    </div> 
                    <div class="message"> 
                        <p><?php echo $row['message']; ?></p> 
                        
                    </div> 
                    <small><?php echo $row['created_at'];?></small>
                </div> 
                <br> 
            <?php } 
        } else { 
            echo "<div class='reply_box'>No messages found</div>"; 
        } ?> 
        <br> 
        
        <div class="reply"> 
            <a href="backend/readmessage.php"> 
                <button id="readbtn"><i class="fas fa-check"></i> Mark all as read</button> 
            </a> 
            
            <?php 
            $select_replies = "SELECT * FROM replies ORDER BY id DESC"; 
            $result1 = mysqli_query($connection, $select_replies); 
            
            if($result1 && mysqli_num_rows($result1) > 0){ 
                while($row = mysqli_fetch_assoc($result1)){ 
                    if($row['status'] == "Read"){ 
                        $reply_style = "background: #0c2a3a; color: #fff;"; 
                    } else { 
                        $reply_style = "background: ##0000c2a3a; color: #fff;"; 
                    } 
                    ?> 
                    
                    <div class="reply_box" style="<?php echo $reply_style; ?>"> 
                        <div class="details"> 
                            <div class="avatar"> 
                                <p><?php echo $first_letter; ?></p> 
                            </div> 
                        </div> 
                        <p><?php echo $row['reply']; ?></p> 
                        <small id="status"><?php echo $row['status']; ?></small> 
                    </div> 
                <?php } 
            } ?> 
        </div> 
    </div> 
</div> 
</body> 
</html>
