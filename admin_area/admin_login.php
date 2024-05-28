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
        background-color: #f8f9fa; 
    }
    .form-container {
        background-color: #d1ecf1; 
        padding: 20px; 
        border-radius: 10px; 
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
    }
    .form-label {
        color: #212529;
    }
    .form-control {
        background-color: #fff;
    }
    .btn-login {
        background-color: #dc3545; 
        border-color: #dc3545; 
    }
    .btn-login:hover {
        background-color: #c82333; 
        border-color: #bd2130; 
    }
    .btn-register {
        color: #0d6efd; 
        text-decoration: none; 
    }
    .btn-register:hover {
        color: #0b5ed7; 
        text-decoration: underline; 
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
                    <div class="form-outline mb-4">
                        <label for="pin" class='form-label'>Admin PIN</label>
                        <input type="password" id="pin" class='form-control' placeholder="Enter PIN" autocomplete='off' required='required' name='pin'>
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
    $admin_pin = $_POST['pin'];

    // Query to select admin details
    $select_query = "SELECT * FROM `admin_table` WHERE admin_username='$admin_username'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);
    $row_data = mysqli_fetch_assoc($result);
    $admin_ip = getIPAddress();

    // Check if the admin exists
    if ($row_count > 0) {
        // Verify password
        if (password_verify($admin_password, $row_data['admin_password'])) {
            // Query to check admin PIN
            $pin_query = "SELECT * FROM `admin_pin` WHERE pin='$admin_pin'";
            $pin_result = mysqli_query($con, $pin_query);
            $pin_count = mysqli_num_rows($pin_result);

            // Verify PIN
            if ($pin_count > 0) {
                $_SESSION['admin_username'] = $admin_username;
                echo "<script>alert('Login successful')</script>";
                echo "<script>window.location.href = './index.php'</script>";
            } else {
                echo "<script>alert('Invalid PIN')</script>";
            }
        } else {
            echo "<script>alert('Invalid Credentials')</script>";
        }
    } else {
        echo "<script>alert('Invalid Credentials')</script>";
    }
}
?>
