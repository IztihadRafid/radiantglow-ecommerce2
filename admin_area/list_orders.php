<h3 class="text-center text-dark mt-3"> All Orders</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-dark text-white ">
        <?php
        $get_orders = "select * from `user_orders`";
        $result = mysqli_query($con, $get_orders);
        $row_count = mysqli_num_rows($result);
       


        if ($row_count == 0) {
            echo "<h2 class= 'text-danger text-center mt-5'>No Orders Yet</h2>";
        } else {
            echo "<tr class='text-center'>
            <th>Sl no</th>
            <th>Amount Due</th>
            <th>Invoice Number</th>
            <th>Total Products</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Delete</th>
            
            </tr>
            </thead>
            <tbody class ='bg-secondary text-center text-light'>";
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $user_id = $row_data['user_id'];
                $amount_due = $row_data['amount_due'];
                $total_products = $row_data['total_products'];
                $invoice_number = $row_data['invoice_number'];
                $order_date = $row_data['order_date'];
                $order_status = $row_data['order_status'];
                $number++; ?>
                
        <tr>

        <td><?php echo $number; ?></td>
        <td><?php echo $amount_due;?></td>
        <td><?php echo $invoice_number;?></td>
        <td><?php echo $total_products;?></td>
        <td><?php echo $order_date;?></td>
        <td><?php echo $order_status;?></td>
        <td><a href='index.php?delete_all_orders=<?php echo $order_id?>' type="button" class="text-light" data-toggle="modal" data-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>

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
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="./index.php?list_orders" class='text-light text-decoration-none'>No</a></button>
        <button type="button" class="btn btn-primary"><a href='index.php?delete_all_orders=<?php echo $order_id?>' class="text-light text-decoration-none" >Yes</a></button>
      </div>
    </div>
  </div>
</div>