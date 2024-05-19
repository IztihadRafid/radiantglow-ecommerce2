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
    <title>Cart Details</title>
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

        .cart_img {
            width: 80px;
            height: 80px;
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
                <img id="logo-image" src="images/logopic.png" alt="">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                            <a class="nav-link text-white" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="cart.php"><i class="fa-solid fa-cart-shopping"><sup><?php cart_item(); ?></sup></i></a>
                        </li>

                        

                    </ul>

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
        <div class='bg-light w-75 mx-auto mb-5 mt-4'>
            <h2 class="text-center">All Carts</h2>
            <!-- <p class="text-center fs-5">Explore top-notch advice and premium products for your dermal, locks, oral, and facial care regimen on our dedicated website.</p> -->
            
        </div>

        <!--fourth Child-->
        <div class="container">
            <div class="row">
                <form action="" method="post">
                <table class="table table-bordered text-center">
                    
                        <!--php code to display dynamic data-->
                        <?php
                         global $con;
                         $get_ip_add = getIPAddress(); 
                         $total_price=0;
                         $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                         $result= mysqli_query($con,$cart_query);
                         $result_count = mysqli_num_rows($result);
                         if($result_count>0){
                            echo "<thead>
                            <tr>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Remove</th>
                                <th colspan='2'>Operations</th>
                            </tr>
                        </thead>
                        <tbody>";
                         
                         while($row=mysqli_fetch_array($result)){
                             $product_id=$row['product_id'];
                             $select_products="Select * from `products` where product_id='$product_id'";
                             $result_products= mysqli_query($con,$select_products);
                             while($row_product_price=mysqli_fetch_array($result_products)){
                                 $product_price=array($row_product_price['product_price']);
                                 $price_table =$row_product_price['product_price'];
                                 $product_title =$row_product_price['product_title'];
                                 $product_image1 =$row_product_price['product_image1'];
                                 $product_values=array_sum($product_price);
                                 $total_price= $total_price+$product_values;   
                        ?>
                        
                        
                        <tr>
                            <td><?php echo $product_title ?></td>
                            <td><img src="./admin_area/product_images/<?php echo $product_image1 ?>" alt="" class='cart_img'></td>
                            <td><input type="text" name="qty" class="form-input w-50"></td>
                            <?php 
                            $get_ip_add = getIPAddress(); 
                            if(isset($_POST['update_cart'])){
                                $quantities = $_POST['qty'];
                                $update_cart="update `cart_details` set quantity= $quantities where ip_address='$get_ip_add'";
                                $result_products_quantity= mysqli_query($con,$update_cart);
                                $total_price=$total_price*$quantities;
                            }
                             ?>
                            <td><?php echo $price_table?> Tk</td>
                            <td><input type="checkbox" name='removeitem[]' value="<?php echo $product_id ?>"></td>
                            <td>
                                <!-- <button class="bg-primary text-white px-3 py-2 border-0 rounded-3 mx-3">Update</button> -->
                                <input type="submit" value="Update Cart" class="bg-primary text-white px-3 py-2 border-0 rounded-3 mx-3" name='update_cart'>
                                <!-- <button class="bg-primary text-white px-3 py-2 border-0 rounded-3 mx-3">Remove</button> -->
                                <input type="submit" value="Remove Cart" class="bg-primary text-white px-3 py-2 border-0 rounded-3 mx-3" name='remove_cart'>
                            </td>
                        </tr>
                        <?php 
                        }
                    }}

                    else{
                        echo "<h1 class='text-center text-danger p-2'>Cart is Empty</h1>";


                    }
                        ?>
                    </tbody>
                </table>
                <!--subTotal-->
                <div class="d-flex mb-5">
                    <?php  
                    
                    $get_ip_add = getIPAddress(); 
                   
                    $cart_query="Select * from `cart_details` where ip_address='$get_ip_add'";
                    $result= mysqli_query($con,$cart_query);
                    $result_count = mysqli_num_rows($result);
                    if($result_count>0){
                        echo "<h4 class='px-3'>Subtotal: <strong>$total_price Tk </strong></h4>
                        <input type='submit' value='Continue Shopping' class='bg-primary text-white px-3 py-2 border-0 rounded-3 mx-3' name='continue_shopping'>
                        <button class='bg-dark text-white px-3 py-2 border-0 rounded-3'><a class='text-white text-decoration-none' href='./users_area/checkout.php'>Check Out</a></button> ";
                    }else{
                        echo "<input type='submit' value='Continue Shopping' class='bg-primary text-white px-3 py-2 border-0 rounded-3 mx-3' name='continue_shopping'>";
                    }
                    if(isset($_POST['continue_shopping'])){
                        echo "<script>window.open('index.php','_self')</script>";
                    }
                    ?>
                
                </div>
            </div>
        </div>
        </form>
    <!-- function To Remove Items-->
    <?php 
    function remove_cart_item(){
        global $con;
        if(isset($_POST['remove_cart'])){
            foreach($_POST['removeitem'] as $remove_id){
                echo $remove_id;
                $delete_query= "Delete from `cart_details` where product_id= $remove_id";
                $run_delete= mysqli_query($con,$delete_query);
                if($run_delete){
                    echo "<script>window.open('cart.php','_self')</script>";
                }
            }
        }
    }
    echo $remove_item = remove_cart_item();
    ?>



        <!-- last child FOOTER -->
        <!-- include footer -->
        <?php
        include("./includes/footer.php");
        ?>
    </div>
</body>

</html>