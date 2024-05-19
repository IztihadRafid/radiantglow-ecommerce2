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
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
.admin_image{
    width:100px;
    object-fit: contain;

}
.footer{
    position: absolute;
    bottom: 0;

}
 body{
overflow-x: hidden;

 }   
 .product_img{
    width: 100px;
    object-fit: contain;
 }
 </style>
</head>

<body>
    <!-- navbar -->
    <div class="container-fluid p-0">
        <!-- first child -->
        <nav class="navbar navbar-extend-lg navbar-light custom_bg-black">
            <div class="container-fluid">
                <img id="logo-image" src="../images/logopic.png" alt="">

                <nav class="navbar navbar-extend-lg">

                    <ul class="navbar-nav d-flex">
                    
                     <?php
                      if(isset($_SESSION['admin_username'])){
                   
                        echo " <li class='nav-item'>
                        <a class='nav-link text-white' href='./index.php'> Welcome ".$_SESSION['admin_username']. " </a>
                        </li>";
                       }

                       if(!isset($_SESSION['admin_username'])){
                        echo " <li class='nav-item'>
                        <a class='nav-link' href='./admin_login.php'> Login </a>
                        </li>";
                             }else{
                
                            echo " <li class='nav-item'>
                            <a href='./logout.php' class='text-decoration-none text-white '>Logout</a>
                            </li>";
                               }
?>
                         <li class="nav-item">
                        <a class="nav-link text-white" href="../index.php"> Home </a>
                        </li>
                            

                    </ul>
                </nav>
            </div>
        </nav>

        <!-- second child -->
        <div class="bg-light">
            <h3 class="text-center p-3">Admin Dashboard</h3>
        </div>

        <!-- third child -->
        <div class="row ">
            <div class="col-md-12 bg-secondary p-2  align-items-center">
                
                <div class="button text-center">
                    <button class='btn-inventory'><a href="insert_product.php" class="nav-link  bg-info my-1 text-dark fw-bold">Insert Products</a></button>
                    <button class='btn-inventory'><a href="index.php?view_products" class="nav-link bg-info my-1 text-dark fw-bold">View Products</a></button>
                    <button class='btn-inventory'><a href="index.php?insert_category" class="nav-link bg-info my-1 text-dark fw-bold">Insert Categories</a></button>
                    <button class='btn-inventory'><a href="index.php?view_categories" class="nav-link bg-info my-1 text-dark fw-bold">View Categories</a></button>
                    <button class='btn-inventory'><a href="index.php?insert_brand" class="nav-link bg-info my-1 text-dark fw-bold">Insert Brands</a></button>
                    <button class='btn-inventory'><a href="index.php?view_brands" class="nav-link bg-info my-1 text-dark fw-bold">View Brands</a></button>
                    <button class='btn-inventory'><a href="index.php?list_orders" class="nav-link bg-info my-1 text-dark fw-bold">All Orders</a></button>
                    <button class='btn-inventory'><a href="index.php?list_payments" class="nav-link bg-info my-1 text-dark fw-bold">All Payments</a></button>
                    <button class='btn-inventory'><a href="index.php?list_users" class="nav-link bg-info my-1 text-dark fw-bold">List Users</a></button>
              
                </div>
            </div>
        </div>

    <!-- Fourth Child -->
    <div class='container my-5'>
    <?php
        if(isset($_GET['insert_category'])){
            include('insert_categories.php');
        }
        if(isset($_GET['insert_brand'])){
            include('insert_brands.php');
        }
        if(isset($_GET['view_products'])){
            include('view_products.php');
        }
        if(isset($_GET['edit_products'])){
            include('edit_products.php');
        }
        if(isset($_GET['delete_product'])){
            include('delete_product.php');
        }
        if(isset($_GET['view_categories'])){
            include('view_categories.php');
        }
        if(isset($_GET['view_brands'])){
            include('view_brands.php');
        }
        if(isset($_GET['edit_category'])){
            include('edit_category.php');
        }
        if(isset($_GET['edit_brands'])){
            include('edit_brands.php');
        }
        if(isset($_GET['delete_category'])){
            include('delete_category.php');
        }
        if(isset($_GET['delete_brand'])){
            include('delete_brand.php');
        }
        if(isset($_GET['list_orders'])){
            include('list_orders.php');
        }
        if(isset($_GET['delete_all_orders'])){
            include('delete_all_orders.php');
        }
        if(isset($_GET['list_payments'])){
            include('list_payments.php');
        }
        if(isset($_GET['delete_all_payments'])){
            include('delete_all_payments.php');
        }
        if(isset($_GET['list_users'])){
            include('list_users.php');
        }
        
    ?>
    
    
    </div>


        <!-- last child FOOTER -->
       <?php include("../includes/footer.php"); ?>
    </div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>