<?php
include("../includes/connect.php");
if (isset($_POST['insert_cat'])) {
  $category_title = $_POST['cat_title'];

  //select data from database
  $select_query = "Select * from `categories` where category_title='$category_title'";
  $result_select = mysqli_query($con, $select_query);
  $number = mysqli_num_rows($result_select);
  if ($number > 0) {
    echo "<script>alert('Category is Already Present Inside Database')</script>";
  } else {
    $insert_query = "insert into `categories` (category_title) values('$category_title')";
    $result = mysqli_query($con, $insert_query);
    if ($result) {
      echo "<script>alert('Category Has Been Inserted Successfully')</script>";
    }
  }
}
?>

<h2 class='text-center'>Insert Categories</h2>
<form action="" method="post" class='mb-2'>
  <div class="input-group mb-3 w-90">
    <span class="input-group-text bg-info" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
    <input type="text" name="cat_title" class="form-control" placeholder="Insert Categories" aria-label="Categories" aria-describedby="basic-addon1">
  </div>
  <div class="input-group mb-3 w-10 m-auto">

    <input type="submit" name="insert_cat" class="bg-info rounded-3 fw-bold border-0 p-3 my-3" value="Insert Categories">

  </div>
</form>