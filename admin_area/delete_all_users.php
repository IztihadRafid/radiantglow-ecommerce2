<?php
if(isset($_GET['delete_all_users'])){ 
    $delete_id=$_GET['delete_all_users'];
// echo $delete_all_users; 

// delete query
$delete_users="Delete from `user_table` where user_id=$delete_id"; 
$result_users=mysqli_query($con, $delete_users);
if($result_users){
echo "<script>alert('User deleted successfully')</script>"; 
echo "<script>window.open('./index.php?list_users', '_self')</script>";
}
}
?>