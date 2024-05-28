<?php
if(isset($_GET['delete_all_payments'])){
    $delete_all_payments= $_GET['delete_all_payments'];
    
    $delete_query="Delete from `user_payments` where payment_id=$delete_all_payments";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('payment is been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_payments', '_self')</script>";
    }
}

