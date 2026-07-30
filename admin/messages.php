<?php
include("../backend/config.php");

$select_messages= "SELECT * FROM messages ORDER BY ID DESC";

$results = mysqli_query($connection , $select_messages);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="message-container">
        <h2>Incomings</h2>

        <a href="reply.html">
            <button id="add_message_btn">Add new message</button>
        </a>
       
        <div class="message-box-wrapper">
            
        <?php
            if($results && mysqli_num_rows($results)>0){
                while($row = mysqli_fetch_assoc($results)){?>
                    <div class="message-box">
                        
                        
                        <div class="message">
                            <p><?php echo $row['message'];?></p>
                            
                        </div>

                        <div class="manage-message-btns">
                            <a href="reply.html">
                                <button id="replybtn"><i class="fas fa-reply"></i>    Reply</button>
                            </a>
                             <a href="../backend/delete_message.php?id=<?php echo $row['id'];?>">
                                <button id="delbtn"onclick="return confirm('Delete this message?')"><i class="fas fa-trash"></i>    Delete </button>
                            </a>
                        </div>
                    </div>
                    <br>
                <?php
                }
            }
            else{
                echo"<div class='reply_box'>This message was deleted</div><br>";
            }?>
       

            <div class="reply">
                <?php
                $select_messages= "SELECT * FROM replies ORDER BY ID DESC";

                $result1 = mysqli_query($connection , $select_messages);

                if($result1 && mysqli_num_rows($result1)>0){
                    while($row = mysqli_fetch_assoc($result1)){?>
                        <div class="reply-box">
                            <p><?php echo $row['reply']?></p>
                            
                            <div class="manage-message-btns">
                                <a href="edit.php">
                                    <button id="Editbtn"><i class="fas fa-pen"></i>    Edit</button>
                                </a>
                                <a href="../backend/delete_message.php?id=<?php echo $row['id'];?>">
                                    <button id="deletebtn"><i class="fas fa-trash"></i>    Unsend </button>
                                </a>
                            </div>
                        </div>
                        
                    <?php
                    }
                }else{
                    echo"<div class='reply_box'>This message has been deleted</div>";
                }?>
            </div>
        </div>
            
    </div>
</body>
</html>