<?php 
include('../includes/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray */
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1); /* Soft shadow */
        }
        .form-label {
            color: #495057; /* Dark gray */
        }
        .btn-register {
            background-color: #007bff; /* Blue */
            border-color: #007bff; /* Blue */
            display: block;
            margin: 0 auto; /* Center the button */
        }
        .btn-register:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Darker blue on hover */
        }
        .login-link {
            color: #dc3545; /* Red */
        }
        .login-link:hover {
            color: #bd2130; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <div class="container-fluid my-3">
        <h2 class="text-center p-4">Admin Registration</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                <div class="form-container bg-white">
                    <form action="" method="post" enctype="multipart/form-data">

                        <!-- username field -->
                        <div class="form-outline mb-4">
                            <label for="admin_username" class='form-label'>Username</label>
                            <input type="text" id="admin_username" class='form-control' placeholder="Enter Your Username" autocomplete='off' required='required' name='admin_username'>
                        </div>

                        <!-- user Email field -->
                        <div class="form-outline mb-4">
                            <label for="admin_email" class='form-label'>Email</label>
                            <input type="email" id="admin_email" class='form-control' placeholder="Enter Your Email" autocomplete='off' required='required' name='admin_email'>
                        </div>

                        <!-- user Password field -->
                        <div class="form-outline mb-4">
                            <label for="admin_password" class='form-label'>Password</label>
                            <input type="password" id="admin_password" class='form-control' placeholder="Enter Your Password" autocomplete='off' required='required' name='admin_password'>
                        </div>

                        <!-- user confirm Password field -->
                        <div class="form-outline mb-4">
                            <label for="conf_admin_password" class='form-label'>Confirm Password</label>
                            <input type="password" id="conf_admin_password" class='form-control' placeholder="Confirm Your Password" autocomplete='off' required='required' name='conf_admin_password'>
                        </div>
                        <div class="form-outline mb-4">
                            <label for="pin" class='form-label'>Enter Admin PIN</label>
                            <input type="text" id="pin" class='form-control' placeholder="PIN" autocomplete='off' required='required' name='pin'>
                        </div>
                        <div class="mt-4 pt-2">
                            <input type="submit" value="Register" class='btn btn-register py-3 px-3 border-0 text-white rounded-3' name='admin_register'>
                            <p class='fw-bold mt-2 p-2 text-center'>Already Have An Account? <a href="admin_login.php" class="login-link">Login</a></p>
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
if (isset($_POST['admin_register'])) {
    $admin_username = $_POST['admin_username'];
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];
    $conf_admin_password = $_POST['conf_admin_password'];
    $admin_pin = $_POST['pin'];

    // Check if username or email already exists
    $select_query = $con->prepare("SELECT * FROM `admin_table` WHERE admin_username=? OR admin_email=?");
    $select_query->bind_param("ss", $admin_username, $admin_email);
    $select_query->execute();
    $result = $select_query->get_result();
    $rows_count = $result->num_rows;

    if ($rows_count > 0) {
        echo "<script>alert('Username or Email already exists');</script>";
    } elseif ($admin_password != $conf_admin_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } elseif (strlen($admin_password) < 6 || !preg_match("/[A-Z]/", $admin_password) || !preg_match("/[\W]/", $admin_password)) {
        echo "<script>alert('Password must be at least 6 characters long, contain at least one uppercase letter and one special character');</script>";
    } else {
        // Hash the password
        $hash_password = password_hash($admin_password, PASSWORD_DEFAULT);

        // Check if the entered PIN matches the stored PIN
        $pin_query = $con->prepare("SELECT * FROM `admin_pin` WHERE pin=?");
        $pin_query->bind_param("s", $admin_pin);
        $pin_query->execute();
        $pin_result = $pin_query->get_result();
        $pin_count = $pin_result->num_rows;

        if ($pin_count > 0) {
            // Insert query for admin registration
            $insert_query = $con->prepare("INSERT INTO `admin_table` (admin_username, admin_email, admin_password) VALUES (?, ?, ?)");
            $insert_query->bind_param("sss", $admin_username, $admin_email, $hash_password);
            $sql_execute = $insert_query->execute();

            if ($sql_execute) {
                echo "<script>alert('Registration successful');</script>";
                echo "<script>window.open('./admin_login.php', '_self')</script>";
            } else {
                echo "<script>alert('Error: Registration failed');</script>";
            }
        } else {
            echo "<script>alert('Invalid PIN');</script>";
        }
    }
}
?>
?>

