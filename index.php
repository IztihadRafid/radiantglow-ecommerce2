<?php
include("includes/connect.php");
include("functions/common_function.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radiant Glow</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <style>
    .golden-value {
        color: #f5dd05;
    }
    body{
        overflow-x:hidden;
    }
   </style>
    
    
    
</head>

<body>
    <!-- Navbar -->
    <div class="container-fluid p-0 ">
        <!-- first Child -->
        <nav class="navbar navbar-expand-lg navbar-light custom_bg-black">
            <div class="container-fluid">
                <img id="logo-image" src="images/logopic.png" alt="">
                <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="display_all.php">Products</a>
                        </li>
                        <?php 
                        if(isset($_SESSION['username'])){
                            echo  "<li class='nav-item'>
                            <a class='nav-link text-white' href='./users_area/profile.php'>My Account</a>
                        </li>";
                        }else{
                            echo  "<li class='nav-item'>
                            <a class='nav-link text-white' href='./users_area/user_registration.php'>Register</a>
                            </li>";
                        }
                        ?>
                        
                        <li class="nav-item">
                            <a class="nav-link text-white" href="contact_us.php">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item();?></sup></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./users_area/checkout.php">Total Price: <span class="golden-value"><?php total_cart_price()?> Tk</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./admin_area/admin_login.php">Inventory Management</a>
                        </li>

                    </ul>
                    <form class="d-flex" action="search_product.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name='search_data'>
                        <input type="submit"  value="Search" class='btn btn-outline-success' name='search_data_product'>
                    </form>
                </div>
            </div>
        </nav>
        <!-- calling cart function -->
        <?php 
            cart();
        ?>
        <!-- Second Child  -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
            <ul class="navbar-nav me-auto">

            <?php
                if(!isset($_SESSION['username'])){
                    echo " <li class='nav-item'>
                    <a class='nav-link text-white' href='#'> Welcome Guest </a>
                    </li>";
                }else{
            
                        echo " <li class='nav-item'>
                        <a class='nav-link text-white' href='#'> Welcome ".$_SESSION['username']. " </a>
                        </li>";
                }

                if(!isset($_SESSION['username'])){
                    echo " <li class='nav-item'>
                    <a class='nav-link' href='./users_area/user_login.php'> Login </a>
                    </li>";
                }else{
            
                        echo " <li class='nav-item'>
                        <a class='nav-link' href='./users_area/logout.php'> Logout </a>
                        </li>";
                }


                ?>
            </ul>
        </nav>

        <!-- Third child -->
        <div class='bg-light w-75 mx-auto'>
            <h2 class="text-center">Radiant Glow</h2>
            <p class="text-center fs-5">Explore top-notch advice and premium products for your dermal, locks, oral, and facial care regimen on our dedicated website.</p>
            <p class="text-center fs-5 text-primary">Featured Products</p>
        </div>

        <!-- fourth child -->
        <div class="row px-3">
            <div class="col-md-10">
                <!-- Products -->
                <div class="row">
                    <!-- fetching products cards -->
                    <?php 
                    // calling function
                   getproducts();
                   get_unique_categories();
                   get_unique_brands();
                //    $ip = getIPAddress();  
                //     echo 'User Real IP Address - '.$ip;         
                    ?>
                   
                    <!--row end  -->
                   
                </div>
                <!-- col end -->
            </div>
            <!-- sidenavbar -->
            <div class="col-md-2 bg-secondary p-0">
                <!-- brands list-->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-white">
                            <h4>Delivary Brands</h4>
                        </a>
                    </li>
                    <?php
                    getbrands();
                    ?>
                    
                </ul>

                <!-- category list -->
                <ul class="navbar-nav me-auto text-center">
                    <li class="nav-item bg-info">
                        <a href="#" class="nav-link text-white">
                            <h4>Categories</h4>
                        </a>
                    </li>
                    <?php
                    getcategories();
                    ?>
                </ul>
            </div>
        </div>



        <!-- last child FOOTER -->
        <!-- include footer -->
        <?php
        include("./includes/footer.php");
        ?>
    </div>
</body>

</html>