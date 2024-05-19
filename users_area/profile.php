
<?php
include("../includes/connect.php");
include("../functions/common_function.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?php echo $_SESSION['username'] ?> </title>
    <link rel="stylesheet" href="../style.css">
    <!-- Bootstrap CSS -->
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
    .profile_img{
    width:80%;
    margin: auto;
    display: block;
    /*height:100%; */  
    object-fit: contain;
     }
     .edit_image{
    width:100px;
    height:100px;
    object-fit: contain;
}
   </style>
    
    
</head>

<body>
    <!-- Navbar -->
    <div class="container-fluid p-0 ">
        <!-- first Child -->
        <nav class="navbar navbar-expand-lg navbar-light custom_bg-black">
            <div class="container-fluid">
                <img id="logo-image" src="../images/logopic.png" alt="">
                <button class="navbar-toggler"  type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active text-white" aria-current="page" href="../index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../display_all.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="./profile.php">My Account</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="../cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item();?></sup></i></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Total Price: <span class="golden-value"><?php total_cart_price()?> Tk</span></a>
                        </li>
                       
                    </ul>
                    <form class="d-flex" action="../search_product.php" method="get">
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
                        <a class='nav-link' href='./logout.php'> Logout </a>
                        </li>";
                }


                ?>
            </ul>
        </nav>

        <!-- Third child -->
        <div class='bg-light w-100 mx-auto'>
            <h2 class="text-center">Radiant Glow</h2>
            <p class="text-center fs-5">Elevate your skincare with premium products and expert advice on our exclusive site.</p>
        </div>


    
<!-- fourth child -->
<div class="row mt-4">
            <div class="col-md-2 ">
                <ul class="navbar-nav bg-secondary text-center" style="height:100vh">
                    <li class="nav-item bg-dark">
                        <a class="nav-link text-light" href="#">
                            <h4>Your profile</h4>
                        </a>
                    </li>

<?php 
$username= $_SESSION['username'];
$user_image= "select * from `user_table` where username='$username'";
$result_image=mysqli_query($con, $user_image);
$row_image=mysqli_fetch_array($result_image);
$user_image=$row_image['user_image'];

echo "<li class='nav-item'>
        <img src='./user_images/$user_image' class='profile_img' alt='profile_img'>
     </li>";
?>
                   
                    <li class="nav-item ">

                        <a class="nav-link text-light" href="profile.php">Pending Orders</a>
                    </li>
                    <li class="nav-item ">

                        <a class="nav-link text-light" href="profile.php?edit_account">Edit Account</a>
                    </li>
                    <li class="nav-item ">

                        <a class="nav-link text-light" href="profile.php?my_orders">My Orders</a>
                    </li>
                    <li class="nav-item ">

                        <a class="nav-link text-light" href="profile.php?delete_account">Delete Account</a>
                    </li>
                    <li class="nav-item ">

                        <a class="nav-link text-light" href="logout.php">Logout</a>
                    </li>

                </ul>
            </div>
            <div class="col-md-10 text-center" >
                <?php  
                
                        get_user_order_details();

                        if(isset($_GET['edit_account'])){
                            include('edit_account.php');
                        }
                        
                        if(isset($_GET['my_orders'])){
                            include('user_orders.php');
                        }
                        if(isset($_GET['delete_account'])){
                            include('delete_account.php');
                        }

                ?>
            </div>
        </div>


        <!-- last child FOOTER -->
        <!-- include footer -->
        <?php
        include("../includes/footer.php");
        ?>
    </div>
</body>

</html>