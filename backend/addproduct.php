<?php

include("config.php");


if(isset($_POST['addproduct_btn'])){

    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];

    $product_image= $_FILES['product_image']['name'];

    $tmp = $_FILES['product_image']['tmp_name'];

    $folder = "../products_images/".$product_image;

    move_uploaded_file($tmp,$folder);

    #insert into database

    $add_to_db = "INSERT INTO products (product_name,product_category,product_price,product_image)
                 VALUES ('$product_name','$product_category','$product_price','$product_image')";

    $results = mysqli_query($connection, $add_to_db);

    if($results){
       
        header("Location: ../admin/products.php");
        exit();
    }

}
?>