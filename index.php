<?php
session_start();
include("backend/config.php");

if(!isset($_SESSION['fname'])){

    header("Location: loginmessage.html");

    exit();

}



//profile avatar

$den=strtoupper(substr($_SESSION['fname'],0,1));

//replies
$select ="SELECT count(*) as total_replies FROM replies where status='Unread'";

$results = mysqli_query($connection, $select);

$total_replies = 0;

if($results && mysqli_num_rows($results)>0){

    $row = mysqli_fetch_assoc($results);
     
    $total_replies=$row['total_replies'];

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome-free-7.2.0-web/css/all.min.css">
</head>
<body>
    <header>
        <nav id="navbar">
            <div class="nav-content">
                <button id="menubtn">
                <div class="sticks">
                    <div class="stick"></div>
                    <div class="stick"></div>
                    <div class="stick"></div>
                </div>
                </button>
                <div class="name">
                    <p class="shop"><i class="fas fa-star"></i>   <strong style="font-weight: 600;">JNR </strong>LABTRONICS <br><small>ELECTRICAL & BAGS CENTRE</small></p>
                </div>
            </div>
        </nav>

        <div class="features">
            
            <a href="#"id="open_cart">
                <i class="fas fa-shopping-cart"></i>Cart
            </a>
            

            <div class="profile-avatar"id="profilebtn">
                <small id="my_firstletter"><?php echo $den;?></small>
            </div>
            

        </div>

    </header>
   
    <div id="overlay"></div>
    <div id="menubar"class="menubar">
        <button id="closemenu">
            <i class="fas fa-xmark"></i>
        </button>

        <a href="index.php"><i class="fas fa-shop"></i>   Home</a>
        <a href="about.html"><i class="fas fa-question"></i>   About</a>
        <a href="shop.php"><i class="fas fa-shopping-cart"></i>   Our products</a>
        <a href="contact.html"><i class="fas fa-phone"></i>   Contact Us</a>
        <a href="reviews.php"><i class="fas fa-heart"></i>   Reviews</a>
    </div>
  
    <section id="home">
        <div class="home-content-wrapper">
            <div class="welcome-message">
                <div class="theme-wrapper">
                    <div class="image">
                        <div class="slider">
                            <div class="slides">
                                <img src="shopping.webp" id="heros_image" alt="">
                                <img src="images (1).jpeg" id="heros_image" alt="">
                                <img src="1.jpg"id="heros_image" alt="">
                                <img src="images.jpeg" id="heros_image" alt="">
                            </div>
                            
                        </div>
                       
                    </div>
                    <div class="theme">
                        <small class="welcome">WELCOME TO</small>
                        <h2><i class="fas fa-star"></i>   JNR LABTRONICS </h2>
                        <p class="vision">Quality Electronics. Quality Bags .Everything You Need.</p>
                        
                        <small>We bring quality , genuine and lasting products close to the consumers.</small>
                        
                        <br><br>
                        <div class="buttons">
                            <a href="shop.php"><button id="shop_nowbtn"><i class="fas fa-shopping-bag"></i>     SHOP NOW</button></a>
                            <a href="contact.html">
                                <button id="contact_btn"><i class="fas fa-phone"></i>    CONTACT US</button>
                            </a>
                        </div>
                    </div>
                    
                </div>
            
                
            </div>

            <!-----profile window------> 
            <div class="profile-box"id="profilewindow">
                <a href="customer_account.php">
                    <button id="update_profile_btn"><i class="fas fa-cog"></i>   Manage accout</button>
                </a>
                
                <a href="jnrmessages.php">
                    <button id="logout_btn"><i class="fas fa-bell"></i>   Messages <sup id="notification"><?php echo $total_replies ?></sup></button>
                </a>

                <a href="backend/logout.php">
                    <button id="logout_btn"><i class="fas fa-right-from-bracket"></i>   Logout</button>
                </a>

                <button id="closewindow">Close</button>
            </div>

            <!-----cart window------> 
            <div class="cart-box" id="cartWindow">
                <a href="cart.php">
                    <button id="view-cart"><i class="fas fa-eye"></i>   View my Cart</button>
                </a>
                <a href="">
                    <button id="delete-cart"><i class="fas fa-trash"></i>   Empty Cart</button>
                </a>
                <button id="closecart">Close</button>
            </div>

            
            


            <!----whatsapp-->
            <div class="whatsapp-feature">
                <a href="https://wa.me/254798296907"><i class="fa-brands fa-whatsapp" id="whatsapp"></i>     CHAT WITH US ON WHATSAPP</a>
            </div>


            
        </div>
    </section>
    
    <section id="about" class="about">
        <h2 class="main">About Us</h2>
        <div class="about_content">
            <div class="image">
                <img src="1784487685540 (1).png" id="my_about_image" alt="">
            </div>
            <div class="about-card-wrapper">
                <div class="about_card">
                    <p class="about_title">OUR STORY   <i class="fas fa-book"></i></p>
                    <p>We started very dim , now we offer Quality Electronics. Quality Bags .Everything You Need.

We bring quality , genuine and lasting products close to the consumers..</p>
                </div>

                <div class="about_card">
                    <p class="about_title">MISSION    <i class="fas fa-globe"></i></p>
                    <p>To bring quality products close to the consumers .</p>
                    <p>To ensure fairness in price .</p>
                    <p>To Satisfy the consumers taste with genuine and quality products</p>
                </div>

                <div class="about_card">
                    <p class="about_title">VISION    <i class="fas fa-hand-holding-heart"></i></p>
                    <p>To bring positive impacts in the world of businesses of electronics and bags through legit and good quality of out products.</p>
                </div>
            </div>
            
        </div>
    </section>
<br><br>
    <section id="offer"> 
        <h2>New Arrivals</h2>
        <div class="offers">
        <?php 
        $select ="SELECT * FROM products ORDER BY product_id DESC LIMIT 4";

        $results = mysqli_query($connection,$select);
        
        if($results && mysqli_num_rows($results)>0){
            while($row = mysqli_fetch_assoc($results)){?>

                <div class="offer-card">
                    <div class="img">
                        <img src="products_images/<?php echo $row['product_image'];?>" id="products_image"alt="Image not available at this moment">
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
        }else{
            echo"Products are not available at this momnt, come back later";
        }    
        ?>
            

        </div>
    </section>

    <footer>
        <div class="main-footer">
            <div class="contact-details">
                <h3 class="heading">Contacts</h3>
                <p>For more inquires reach us on:</p>
                <p><i class="fas fa-mobile-screen"></i>:
                    <a href="tel: +254798296907">0798296907</a>
                </p>
                <p><i class="fas fa-envelope"></i>:
                    <a href="https://labanmisango033@gmail.com">labanmisango033@gmail.com</a>
                </p>
                <p><i class="fa-brands fa-whatsapp"></i>:
                    <a href="https://wa.me/254798296907">Whatsapp</a>
                </p>   
            </div>

            <div class="contact-details">
                <h3 class="heading">About us</h3>
                <p>OUR STOTY:</p>
                <p>
                    We bring quality , genuine and lasting products close to the consumers.
                </p>
                
                
            </div>

            <div class="contact-details">
                <h3 class="heading">Mission</h3>
                <p><i class="fas fa-globe"></i>   OUR MISSION</p>
                <p>
                    <p> Ensure fairness in price.</p>
                    <p>Satisfy the consumers taste with genuine and quality products.</p>
                    
                </p>
                
                
            </div>

            <div class="Links">
                <h3 class="heading">Links</h3>
                <a href="index.php">Home</a>
                <a href="shop.php">Products</a>
                <a href="about.html">About us</a>
                <a href="">my cart</a>
                <a href="reviews.php">Client reviews</a>
                <a href="admin/adminlogin.html">Admin</a>
            </div>

            <div class="sub-footer">
                <div class="sub-footer-content">
                    <small>Developed By Denis</small>
                    <small>&copy JNR LABTRONICS ELECTRICAL & BAGS CENTRE</small>
                </div>
            </div>

        </div>
        
    </footer>

    <script src="menubar.js"></script>
</body>
</html>