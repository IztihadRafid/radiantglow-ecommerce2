<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .custom-bg-info {
            background-color: #d1ecf1;
        }
        .custom-bg-dark {
            background-color: #343a40;
        }
        .custom-bg-secondary {
            background-color: #6c757d;
        }
        .text-dark-custom {
            color: #343a40;
        }
        .text-red {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center text-dark-custom">User Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <div class="form-container custom-bg-info">
                    <form action="" method="post" enctype="multipart/form-data">
                        <!-- user name field -->
                        <div class="form-outline mb-4">
                            <label for="user_username" class='form-label text-dark-custom'>Username</label>
                            <input type="text" id="user_username" class='form-control' placeholder="Enter Your Username" autocomplete='off' required='required' name='user_username'>
                        </div>
                        <!-- user Email field -->
                        <div class="form-outline mb-4">
                            <label for="user_email" class='form-label text-dark-custom'>Email</label>
                            <input type="email" id="user_email" class='form-control' placeholder="Enter Your Email" autocomplete='off' required='required' name='user_email'>
                        </div>
                        <!-- user Image field -->
                        <div class="form-outline mb-4">
                            <label for="user_image" class='form-label text-dark-custom'>User Image</label>
                            <input type="file" id="user_image" class='form-control' required='required' name='user_image'>
                        </div>
                        <!-- user Password field -->
                        <div class="form-outline mb-4">
                            <label for="user_password" class='form-label text-dark-custom'>Password</label>
                            <input type="password" id="user_password" class='form-control' placeholder="Enter Your Password" autocomplete='off' required='required' name='user_password'>
                        </div>
                        <!-- user confirm Password field -->
                        <div class="form-outline mb-4">
                            <label for="conf_user_password" class='form-label text-dark-custom'>Confirm Password</label>
                            <input type="password" id="conf_user_password" class='form-control' placeholder="Confirm Your Password" autocomplete='off' required='required' name='conf_user_password'>
                        </div>
                        <!-- user Address field -->
                        <div class="form-outline mb-4">
                            <label for="user_address" class='form-label text-dark-custom'>Address</label>
                            <input type="text" id="user_address" class='form-control' placeholder="Enter Your Address" autocomplete='off' required='required' name='user_address'>
                        </div>
                        <!-- user Contact field -->
                        <div class="form-outline mb-4">
                            <label for="user_contact" class='form-label text-dark-custom'>Contact</label>
                            <input type="text" id="user_contact" class='form-control' placeholder="Enter Your mobile number" autocomplete='off' required='required' name='user_contact'>
                        </div>
                        <div class="mt-4 pt-2 d-flex justify-content-between align-items-center">
                            <input type="submit" value="Register" class='btn btn-primary' name='user_register'>
                            <p class='fw-bold mt-2 p-2 text-dark-custom'>Already Have An Account? <a class="text-red" href="user_login.php">Login</a></p>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<!-- PHP Code -->
<?php 
if(isset($_POST['user_register'])){
    $user_username=$_POST['user_username'];
    $user_email=$_POST['user_email'];
    $user_password=$_POST['user_password'];
    $conf_user_password=$_POST['conf_user_password'];
    $user_address=$_POST['user_address'];
    $user_contact=$_POST['user_contact'];
    $user_image=$_FILES['user_image']['name'];
    $user_image_tmp=$_FILES['user_image']['tmp_name'];
    $user_ip=getIPAddress();

    // Password validation
    if(strlen($user_password) < 6 || !preg_match("/[A-Z]/", $user_password) || !preg_match("/[\W]/", $user_password)){
        echo "<script> alert('Password must be at least 6 characters long, contain at least one uppercase letter and one special character');</script>";
    } 
    // Contact number validation
    else if(!preg_match("/^01\d{9}$/", $user_contact)){
        echo "<script> alert('Invalid Phone Number');</script>";
    } 
    else {
        $hash_password=password_hash($user_password, PASSWORD_DEFAULT);

        // Select query 
        $select_query="Select * from `user_table` where username='$user_username' or user_email='$user_email'";
        $result=mysqli_query($con, $select_query);
        $rows_count=mysqli_num_rows($result);

        if ($rows_count>0) {
            echo "<script> alert('Username and Email already exist')</script>";
        } else if($user_password != $conf_user_password) {
            echo "<script> alert('Passwords do not match')</script>";
        } else {
            // Insert query
            move_uploaded_file($user_image_tmp, "./user_images/$user_image");
            $insert_query="insert into `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
                           values ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_contact')";
            $sql_execute=mysqli_query($con, $insert_query);
            
            if ($sql_execute) {
                echo "<script>alert('Registration successful');</script>";
                echo "<script>window.open('../index.php', '_self')</script>";
            } else {
                echo "<script>alert('Error: Registration failed');</script>";
            }
        }

        // Selecting cart items
        $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
        $result_cart=mysqli_query($con, $select_cart_items);
        $rows_count=mysqli_num_rows($result_cart);
        if($rows_count>0){
            $_SESSION['username']=$user_username;
            echo "<script> alert('You have items in your cart')</script>";
            echo "<script>window.open('checkout.php', '_self')</script>";
        } else {
            echo "<script>window.open('../index.php', '_self')</script>";
        }
    }
}
?>


