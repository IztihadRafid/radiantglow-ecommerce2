<?php 
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
   
    <style>
    body {
        overflow-x: hidden;
        background-color: #f8f9fa; /* Set a light gray background color */
    }
    .form-container {
        background-color: #d1ecf1; /* Set form background color as bg-info */
        padding: 20px; /* Add some padding */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
    }
    .form-label {
        color: #212529; /* Set label color */
    }
    .form-control {
        background-color: #fff; /* Set input background color */
    }
    .btn-login {
        background-color: #dc3545; /* Set login button background color */
        border-color: #dc3545; /* Set login button border color */
    }
    .btn-login:hover {
        background-color: #c82333; /* Darken login button color on hover */
        border-color: #bd2130; /* Darken login button border color on hover */
    }
    .btn-register {
        color: #0d6efd; /* Set register link text color */
        text-decoration: none; /* Remove default underline */
    }
    .btn-register:hover {
        color: #0b5ed7; /* Darken register link text color on hover */
        text-decoration: underline; /* Underline register link on hover */
    }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center">Admin Login</h2>
        <div class="row d-flex align-items-center justify-content-center mt-5">
            <div class="col-lg-10 col-xl-4">
                <form action="" method="post" class="form-container">
                    <!-- Username field -->
                    <div class="form-outline mb-4">
                        <label for="admin_username" class='form-label'>Username</label>
                        <input type="text" id="admin_username" class='form-control' placeholder="Enter Your Username" autocomplete='off' required='required' name='admin_username'>
                    </div>
                    <!-- Password field -->
                    <div class="form-outline mb-4">
                        <label for="admin_password" class='form-label'>Password</label>
                        <input type="password" id="admin_password" class='form-control' placeholder="Enter Your Password" autocomplete='off' required='required' name='admin_password'>
                    </div>
                    <div class="mt-4 pt-2 d-flex justify-content-between align-items-center">
                        <input type="submit" value="Login" class='btn btn-login py-3 px-3 border-0 text-white rounded-3' name='admin_login'>
                        <p class='fw-bold mt-2 p-2'>Don’t Have An Account? <a href="admin_registration.php" class="login-link">Register</a></p>
                        
                    </div>
                </form>  
            </div>
        </div>
    </div>
</body>
</html>

<?php

if (isset($_POST['admin_login'])) {
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    $select_query = "SELECT * FROM `admin_table` WHERE admin_username='$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $admin_ip = getIPAddress();

    // Check if the admin exists
    if ($row_count > 0) {
        $_SESSION['admin_username'] = $admin_username;
        // Verify password
        if (password_verify($admin_password, $row_data['admin_password'])) {
         if ($row_count == 1) {
                $_SESSION['admin_username'] = $admin_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.location.href = './index.php'</script>";
            } 
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
