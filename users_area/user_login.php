<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
    <style>
    body {
        overflow-x: hidden;
        background-color: #f8f9fa; /* Light gray */
    }
    .form-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 30px;
        border-radius: 10px;
        background-color: #fff; /* White */
        box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Soft shadow */
    }
    .form-label {
        color: #495057; /* Dark gray */
    }
    .btn-login {
        background-color: #dc3545; /* Red */
        border-color: #dc3545; /* Red */
        display: block;
        margin: 0 auto; /* Center the button */
    }
    .btn-login:hover {
        background-color: #c82333; /* Darker red on hover */
        border-color: #c82333; /* Darker red on hover */
    }
    .register-link {
        color: #6c757d; /* Gray */
    }
    .register-link:hover {
        color: #007bff; /* Blue on hover */
    }
    </style>
</head>
<body>
    <div class="container-fluid my-5">
        <h2 class="text-center">User Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-12 col-xl-6">
                <div class="form-container">
                    <form action="" method="post">
                        <div class="form-outline mb-4">
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="Enter Your Username" autocomplete="off" required="required" name="user_username">
                        </div>
                        <div class="form-outline mb-4">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Enter Your Password" autocomplete="off" required="required" name="user_password">
                        </div>
                        <div class="mt-4 pt-2">
                            <input type="submit" value="Login" class="btn btn-login py-3 px-3 border-0 text-white rounded-3" name="user_login">
                            <p class="fw-bold mt-2 p-2 text-center">Don't Have An Account? <a href="user_registration.php" class="register-link">Register</a></p>
                            <p class="fw-bold mt-2 p-2 text-center"><a href="OTP.php" class="register-link">Forget Password</a></p>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php

if (isset($_POST['user_login'])) {
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $user_ip = getIPAddress();

    // Check if the user exists
    if ($row_count > 0) {
        $_SESSION['username']= $user_username;
        // Verify password
        if (password_verify($user_password, $row_data['user_password'])) {

            //cart items
            $select_query_cart = "SELECT * FROM `cart_details` WHERE ip_address ='$user_ip'";
            $select_cart = mysqli_query($con, $select_query_cart);
            $row_count_cart = mysqli_num_rows($select_cart);

            if ($row_count == 1 && $row_count_cart == 0) {
                $_SESSION['username']= $user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.location.href = 'profile.php'</script>";
            } else {
                $_SESSION['username']= $user_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.location.href = 'payment.php'</script>";
            }
        } else {
           
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {

        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>

