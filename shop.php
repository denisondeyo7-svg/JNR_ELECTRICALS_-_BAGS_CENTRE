<?php

include("backend/config.php");


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Shop</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="fontawesome-free-7.2.0-web/css/all.min.css">
  </head>
  <body>
    <div class="our_shop">
        <h2 style='color: #007bff;'>Our Shop</h2>
        <div class="items-wrapper">
            <div class="electricals">
            <p class="item-category"><small><i class="fas fa-star" id="item_logo"></i>JNR</small>    Electricals   <i class="fas fa-plug"></i></p>
            <div class="item">

                <?php
                $select = "SELECT * FROM PRODUCTS where product_category='Electricals'";

                $results = mysqli_query($connection,$select);
                
                if($results && mysqli_num_rows($results)>0){
                    while($row = mysqli_fetch_assoc($results)){?>

                        <div class="product-card">
                            <div class="img">
                                <img src="products_images/<?php echo $row['product_image'];?>" alt="Image not availabe" >
                            </div>
                            <div class="name">
                                <p class="product-name"><?php echo $row['product_name'];?></p>
                                <p class="category"><?php echo $row['product_category'];?></p>
                                <p class="price"><?php echo $row['product_price'];?></p>
                            </div>
                            <a href="backend/orders.php">
                                <button type="submit" name="addcart" id="cart_btn"><i class="fas fa-shopping-cart"></i>    Add to cart</button>
                            </a>
                        </div>
                    <?php
                    }   
                }
                else{
                    echo"Products are not available now, come back later";
                }        
                ?>
            </div>
                

            <div class="bags">
                <p class="item-category"><small><i class="fas fa-star" id="item_logo"></i>JNR</small>   Bags   <i class="fas fa-shopping-bag"></i></p>
                <div class="item">
                
                    <?php
                    $select = "SELECT * FROM PRODUCTS where product_category='Bags'";

                    $results = mysqli_query($connection,$select);
                    
                    if($results && mysqli_num_rows($results)>0){
                        while($row = mysqli_fetch_assoc($results)){?>

                            <div class="product-card">
                                <div class="img">
                                    <img src="products_images/<?php echo $row['product_image'];?>" alt="Image not availabe" >
                                </div>
                                <div class="name">
                                    <p class="product-name"><?php echo $row['product_name'];?></p>
                                    <p class="category"><?php echo $row['product_category'];?></p>
                                    <p class="price"><?php echo $row['product_price'];?></p>
                                </div>
                                <a href="backend/orders.php">
                                    <button type="submit" name="addcart" id="cart_btn"><i class="fas fa-shopping-cart"></i>    Add to cart</button>
                                </a>
                            </div>
                        <?php
                        }   
                    }
                    else{
                        echo"Products are not available now, come back later";
                    }        
                    ?>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
