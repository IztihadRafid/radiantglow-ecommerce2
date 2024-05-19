<?php
@session_start();

if(isset($_GET['edit_account'])){
    // Retrieve user data from the database
    $username = $_SESSION['username'];
    $select_query = "SELECT * FROM `user_table` WHERE username='$username'";
    $result_query = mysqli_query($con, $select_query);

    if($result_query && $row_fetch = mysqli_fetch_assoc($result_query)) {
        $user_id = $row_fetch['user_id'];
        $username = $row_fetch['username'];
        $user_email = $row_fetch['user_email'];
        $user_address = $row_fetch['user_address'];
        $user_mobile = $row_fetch['user_mobile'];
        $user_image = $row_fetch['user_image'];
    }
}

if(isset($_POST['user_update'])){
    // Retrieve form data
    $update_id = $user_id;
    $username = trim($_POST['user_username']); // Trim leading and trailing spaces
    $user_email = $_POST['user_email'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];

    // Check if a new image was uploaded
    if(isset($_FILES['user_image']['name']) && $_FILES['user_image']['error'] === UPLOAD_ERR_OK) {
        $user_image = $_FILES['user_image']['name'];
        $user_image_tmp = $_FILES['user_image']['tmp_name'];

        // Move uploaded file to destination directory
        $upload_directory = "./user_images/";
        $target_file = $upload_directory . basename($user_image);
        move_uploaded_file($user_image_tmp, $target_file);
    } else {
        // Use the previous picture if no new picture was uploaded
        $user_image = $row_fetch['user_image'];
    }

    // Update query
    $update_data = "UPDATE `user_table` SET username='$username', user_email='$user_email', user_image='$user_image', user_address='$user_address', user_mobile='$user_mobile' WHERE user_id=$update_id";
    $result_query_update = mysqli_query($con, $update_data);

    if($result_query_update){
        // Update session variables
        $_SESSION['username'] = $username; // Assuming username is updated
        // Display success message and redirect
        echo "<script>alert('Data updated successfully')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    } else {
        // Display error message
        echo "<script>alert('Failed to update data')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .edit_image {
            width: 50px;
            height: 50px;
            object-fit: contain;
            margin-left: 10px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <h3 class="text-center text-success my-4">Edit Account</h3>
        <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="user_username" class="form-label text-start d-block">Username</label>
                    <input type="text" class="form-control" value="<?php echo $username ?>" name="user_username" required>
                </div>
                <div class="mb-3">
                    <label for="user_email" class="form-label text-start d-block">Email</label>
                    <input type="email" class="form-control" value="<?php echo $user_email ?>" name="user_email" required>
                </div>
                <div class="mb-3">
                    <label for="user_image" class="form-label text-start d-block">User Image</label>
                    <div class="d-flex align-items-center">
                        <input type="file" class="form-control" name="user_image">
                        <img src="./user_images/<?php echo $user_image ?>" alt="User Image" class="edit_image">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="user_address" class="form-label text-start d-block">Address</label>
                    <input type="text" class="form-control" value="<?php echo $user_address ?>" name="user_address" required>
                </div>
                <div class="mb-3">
                    <label for="user_mobile" class="form-label text-start d-block">Contact No</label>
                    <input type="text" class="form-control" value="<?php echo $user_mobile ?>" name="user_mobile" required>
                </div>
                <div class="d-grid">
                    <input type="submit" value="Update" class="btn btn-secondary" name="user_update">
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
