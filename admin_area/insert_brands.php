<?php
include("../includes/connect.php");
if (isset($_POST['insert_brand'])) {
  $brand_title = $_POST['brand_title'];

  //select data from database
  $select_query = "Select * from `brands` where brand_title='$brand_title'";
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select);
  if ($number > 0) {
    echo "<script>alert('Brand is Already Present Inside Database')</script>";
  } else {
    $insert_query = "insert into `brands` (brand_title) values('$brand_title')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      echo "<script>alert('Brand Has Been Inserted Successfully')</script>";
    }
  }
}
?>

<h2 class='text-center'>Insert Brands</h2>
<form action="" method="post" class='mb-2'>
<div class="input-group mb-3 w-90">
  <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
  <input type="text" name="brand_title" class="form-control" placeholder="Insert Brands" aria-label="brands" aria-describedby="basic-addon1">
</div>
<div class="input-group mb-3 w-10 m-auto">
  
  <input type="submit" name="insert_brand" class="bg-info rounded-3 fw-bold border-0 p-3 my-3" value="Insert Brands">
  
</div>
</form>