<?php
include("../backend/config.php");

$select ="SELECT * FROM products";

$results = mysqli_query($connection, $select);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product management</title>
    <link rel="stylesheet" href="../fontawesome-free-7.2.0-web/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="product-wrapper">
        <p class="p_title">Products Management</p>

        <div class="management-card">
            <div class="actions">
                <a href="index.php">
                    <button id="go_back"><i class="fas fa-undo"></i>   Back</button>
                </a>
                <a href="add_products.html">
                    <button id="add_product"><i class="fas fa-plus"></i>   Add a product</button>
                </a>
            </div>
            <div class="products">

                <?php
                    if($results && mysqli_num_rows($results)>0){
                        while($row = mysqli_fetch_assoc($results)){?>
                        <div class="product-card">

                            <img src="../products_images/<?php echo $row['product_image'];?>" id="products_image" alt="image not available">
                                <div class="description">
                                    <p class="name"> <?php echo $row['product_name'];?> </p>
                                    <p class="category"><?php echo $row['product_category'];?></p>
                                    <p class="price"><?php echo $row['product_price'];?></p>
                                    
                                </div>
                                <div class="management_buttons">
                                    <a href="../backend/delete_products.php? id=<?php echo $row['product_id'];?>">
                                        <button name= "delete" type ="submit"id="deleteproduct_btn"onclick="return confirm('Delete this product?')"><i class="fas fa-trash"></i>        Delete This Product</button>
                                    </a>
                                    
                                </div>
                            </div>
                        <?php
                    }
                    }else{
                        echo"Products are not available at this moment, check later.";
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>