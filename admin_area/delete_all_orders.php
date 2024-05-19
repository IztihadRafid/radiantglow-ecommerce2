<?php
if(isset($_GET['delete_all_orders'])){
    $delete_all_orders= $_GET['delete_all_orders'];
    //echo $delete_all_orders;
    $delete_query="Delete from `user_orders` where order_id=$delete_all_orders";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Order is been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_orders', '_self')</script>";
    }
}

