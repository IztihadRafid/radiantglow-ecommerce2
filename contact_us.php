<?php
include("./includes/connect.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $username = $con->real_escape_string($_POST['username']);
    $email = $con->real_escape_string($_POST['user_email']);
    $message = $con->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contacts (username, user_email, message) VALUES ('$username', '$email', '$message')";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Message sent successfully!'); window.location.href='contact_us.php';</script>";
    } else {
        echo "<script>alert('Error: " . $con->error . "'); window.location.href='contact_us.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 8px 16px; 
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        h2.text-center {
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
<div class="container mt-5">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <h1>Contact Us</h1>
                <p>Feel free to reach out to us via social media or email.</p>
                <div class="social-icons mt-4">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com" class="btn btn-primary me-2" target="_blank">
                       <i class="fa-brands fa-facebook"></i> Facebook
                    </a>
                    <!-- Gmail -->
                    <a href="https://mail.google.com/" class="btn btn-danger">
                        <i class="fas fa-envelope"></i> Gmail
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <h2 class="text-center">Any Commentary! Feel Free To Message</h2>
        <form action="contact_us.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="username">Name:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="user_email">Email:</label>
                <input type="email" class="form-control" id="user_email" name="user_email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
            </div>
            <div class="text-center"> <!-- Added this div for center alignment -->
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
        <div>
            <button class="btn btn-danger"><a href="index.php" class="text-white" style="text-decoration:none;">Home Page</a></button>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
