<?php
include('../includes/connect.php');
session_start();
if(isset($_GET['order_id'])){
$order_id=$_GET['order_id'];
//echo $order_id;
$select_data="select* from `user_orders` where order_id= $order_id";
$result=mysqli_query($con, $select_data);
$row_fetch= mysqli_fetch_assoc($result);
$invoice_number=$row_fetch['invoice_number'];
$amount_due=$row_fetch['amount_due']; 
}

if(isset($_POST['confirm_payment'])){
$invoice_number=$_POST['invoice_number'];
$amount=$_POST['amount'];
$payment_mode=$_POST['payment_mode'];
$insert_query="insert into `user_payments` (order_id, invoice_number, amount, payment_mode)
values ($order_id, $invoice_number, $amount, '$payment_mode')";
$result=mysqli_query($con, $insert_query);
if($result) {
echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
echo "<script>window.open('profile.php?my_orders', '_self')</script>";
}
$update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
$result_orders=mysqli_query($con, $update_orders);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class ="bg-secondary">
<div class="container my-5">
<h2 class="text-center text-white">Confirm Payment</h2>
<form action="" method="post">
<div class="form-outline my-4 text-center w-50 m-auto">
<label for="" class="text-light">Invoice Number</label>
<input type="text" class="form-control w-50 m-auto" name="invoice_number" value="<?php echo $invoice_number ?>">
</div>
<div class="form-outline my-4 text-center w-50 m-auto">
<label for="" class="text-light">Amount</label>
<input type="text" class="form-control w-50 m-auto" name="amount" value="<?php echo $amount_due ?>">
</div>
<div class="form-outline my-4 text-center w-50 m-auto">
<div>
  <select name="payment_mode" class="form-select w-50 m-auto" required>
    <option value="" disabled selected hidden>Select Payment Mode</option>
    
    <option>Net Banking</option>
    <option>Paypal</option>
    <option>Bkash</option>
    <option>Nagad</option>
    <option>Cash On Delivery</option>
  </select>
</div>
<div class="form-outline my-4 text-center w-50 m-auto">
    <input type="submit" class=" text-light bg-dark py-2 px-3 border-0" value="Confirm" name="confirm_payment">
</div>
</form>
</div>

</body>
</html>