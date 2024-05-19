<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <h3 class="text-danger mt-4 text-center">Delete Account</h3>
    <form action="" method="post" class="mt-5 text-center">
        <div class="form-outline mb-4">
            <button type="button" class="btn btn-danger w-50 m-auto" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">Delete Account</button>
        </div>
        <div class="form-outline mb-4">
            <input type="submit" class="btn btn-secondary w-50 m-auto" name="dont_delete" value="Don't Delete Account">
        </div>
    </form>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete your account? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="" method="post" style="display:inline;">
                        <input type="submit" class="btn btn-danger" name="delete" value="Delete Account">
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php
@session_start(); // Start the session

// Ensure the database connection is established
if (!isset($con)) {
    die('Error: Database connection not established.');
}

// Check if the 'username' session variable is set
if (isset($_SESSION['username'])) {
    $username_session = $_SESSION['username'];
    
    if (isset($_POST['delete'])) {
        // Fetch the user_id for the current user
        $user_query = "SELECT user_id FROM `user_table` WHERE username= '$username_session'";
        $user_result = mysqli_query($con, $user_query);
        
        if ($user_result) {
            $user_row = mysqli_fetch_assoc($user_result);
            $user_id = $user_row['user_id'];
            
            // Delete related records from `user_orders`
            $delete_orders_query = "DELETE FROM `user_orders` WHERE user_id = '$user_id'";
            mysqli_query($con, $delete_orders_query);
            
            // Now delete the user from `user_table`
            $delete_user_query = "DELETE FROM `user_table` WHERE user_id = '$user_id'";
            $delete_result = mysqli_query($con, $delete_user_query);
            
            if ($delete_result) {
                session_destroy();
                echo "<script>alert('Account Deleted successfully')</script>";
                echo "<script>window.open('../index.php', '_self')</script>";
            } else {
                // Output the error if the query fails
                die('Error: ' . mysqli_error($con));
            }
        } else {
            // Output the error if the query fails
            die('Error: ' . mysqli_error($con));
        }
    }
    
    if (isset($_POST['dont_delete'])) {
        echo "<script>window.open('profile.php', '_self')</script>";
    }
} else {
    // Handle case where 'username' session variable is not set
    echo "<p>Error: Username not found in session.</p>";
}
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNvT9e0mYbMT7RnOD8E26UlAwMfyF3A8h32L1DBr+EqJ8EIN1vKHk+PoVX/HE6X" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cb1p7k1LuEelcx3nB2HTbRfiT6i+2eMII0EFdoMyyM00x1+M0tdD3GKt74LJ3r3M" crossorigin="anonymous"></script>
</body>
</html>
