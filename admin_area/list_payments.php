<h3 class="text-center text-dark mt-3"> All Payments</h3>
<table class="table table-bordered mt-5">
    <thead class="bg-dark text-white ">
        <?php
        $get_payments = "select * from `user_payments`";
        $result = mysqli_query($con, $get_payments);
        $row_count = mysqli_num_rows($result);
   

        if ($row_count == 0) {
            echo "<h2 class= 'text-danger text-center mt-5'>No Payments Recieved Yet</h2>";
        } else {
            echo "
            <tr class='text-center'>
              <th>Sl no</th>
              <th>Invoice Number</th>
              <th>Amount</th>
              <th>Payment Mode</th>
              <th>Order Date</th>
              <th>Delete</th>
    
           </tr>
        </thead>
        <tbody class ='bg-secondary text-center text-light'>";
            $number = 0;
            while ($row_data = mysqli_fetch_assoc($result)) {
                $order_id = $row_data['order_id'];
                $payment_id = $row_data['payment_id'];
                $amount = $row_data['amount'];
                $invoice_number = $row_data['invoice_number'];
                $order_date = $row_data['date'];
                $payment_mode = $row_data['payment_mode'];
                $number++;
                echo "
        <tr>
        <td>$number</td>
        <td>$invoice_number</td>
        <td>$amount</td>
        <td>$payment_mode</td>
        <td> $order_date</td>
        <td><a href='./index.php?delete_all_payments' class='text-light' ><i class='fa-solid fa-trash'></i></a></td>
        </tr>";

            }
        }
        ?>



        </tbody>
</table>