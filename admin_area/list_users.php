<h3 class="text-center text-dark mt-3"> All Users</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-dark text-white ">
        <?php
        $get_users = "select * from `user_table`";
        $result = mysqli_query($con, $get_users);
        $row_count = mysqli_num_rows($result);
       if ($row_count == 0) {
            echo "<h2 class= 'text-danger text-center mt-5'>No Users Yet </h2>";
        } else {
            echo "
            <tr class='text-center'>
              <th>Sl no</th>
              <th>Username</th>
              <th>User Email</th>
              <th>User Image</th>
              <th>User Address</th>
              <th>User Mobile</th>
              <th>Delete</th>
    
           </tr>
        </thead>
        <tbody class ='bg-secondary text-center text-light'>";
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $user_id = $row_data['user_id'];
                $username = $row_data['username'];
                $user_email = $row_data['user_email'];
                $user_image = $row_data['user_image'];
                $user_address = $row_data['user_address'];
                $user_mobile = $row_data['user_mobile'];
                $number++;
?>
        <tr class="text-center">
            <td><?php echo $number; ?></td>
            <td><?php echo $username;?></td>
            <td><?php echo $user_email;?></td>
            <td><img src='../users_area/user_images/<?php echo $user_image; ?>' class='product_img' /></td>
             <td><?php echo $user_address;?></td>
              <td><?php echo $user_mobile;?></td>
            <td><a href='index.php?delete_all_users=<?php echo $user_id?>' type="button" class="text-light" data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>

        </tr>
<?php
 }
}
?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">  
      <div class="modal-body">
        <h5>Are you sure you want to delete this?</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?list_users" class='text-light text-decoration-none'>No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_all_users=<?php echo $user_id?>' class="text-light text-decoration-none" >Yes</a></button>
      </div>
    </div>
  </div>
</div>