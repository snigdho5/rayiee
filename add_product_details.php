<?php
session_start();
include('db.php');
$product_name = $_POST["product_name"];
$size = $_POST["size"];
$mrp = $_POST["mrp"];
$qty = $_POST["qty"];
$rate = $_POST["rate"];
$discount_percent = $_POST["discount_percent"];
$discount_amount = $_POST["discount_amount"];

$taxable_amount = $_POST["taxable_amount"];
$sgst_percent = $_POST["sgst_percent"];
$sgst_amount = $_POST["sgst_amount"];
$cgst_percent = $_POST["cgst_percent"];
$cgst_amount = $_POST["cgst_amount"];
$total_amount = $_POST["total_amount"];
$created_by = $_SESSION["user_id"];

$sql = "INSERT INTO tbl_sale_details_temp (product_name,size,mrp,qty,rate,discount_percent,discount_amount,taxable_amount,sgst_percent,sgst_amount,cgst_percent,cgst_amount,total_amount,created_by) VALUES ('$product_name','$size','$mrp','$qty','$rate','$discount_percent','$discount_amount','$taxable_amount','$sgst_percent','$sgst_amount','$cgst_percent','$cgst_amount','$total_amount','$created_by')";
$result = mysqli_query($conn, $sql);

if($result){ 
    $sql2 = "SELECT * FROM tbl_sale_details_temp WHERE created_by = '$created_by'";
    $result2 = mysqli_query($conn, $sql2);
    $num_rows = mysqli_num_rows($result2);

    if($num_rows>0) {
?>
<div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Product Name</th>
          <th scope="col">Size</th>
          <th scope="col">Mrp</th>
          <th scope="col">Qty</th>
          <th scope="col">Rate</th>
          <th scope="col">Discount %</th>
          <th scope="col">Discount Amount</th>
          <th scope="col">Taxable Amount</th>
          <th scope="col">SGST %</th>
          <th scope="col">SGST Amount</th>
          <th scope="col">CGST %</th>
          <th scope="col">CGST Amount</th>
          <th scope="col">Total Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sno = 0;
          $tot_qty = 0;
          $tot_rate = 0;
          $tot_discount_amount = 0;
          $tot_taxable_amount = 0;
          $tot_sgst_amount = 0;
          $tot_cgst_amount = 0;
          $tot_total_amount = 0;
          while($row = mysqli_fetch_assoc($result2)) { 
            $sno = $sno + 1;
            $tot_qty = $tot_qty + $row['qty'];
            $tot_discount_amount = $tot_discount_amount + $row['discount_amount'];
            $tot_sgst_amount = $tot_sgst_amount + $row['sgst_amount'];
            $tot_taxable_amount = $tot_taxable_amount + $row['taxable_amount'];
            $tot_cgst_amount = $tot_cgst_amount+ $row['cgst_amount'];
            $tot_total_amount = $tot_total_amount+ $row['total_amount']; ?>
          <tr>
            <th scope='row'><?php echo $sno ?></th>
            <td><?php echo $row['product_name']; ?></td>
            <td><?php echo $row['size']; ?></td>
            <td style="text-align:right"><?php echo $row['mrp']; ?></td>
            <td style="text-align:right"><?php echo $row['qty']; ?></td>
            <td style="text-align:right"><?php echo $row['rate']; ?></td>
            <td><?php echo $row['discount_percent']; ?></td>
            <td style="text-align:right"><?php echo $row['discount_amount']; ?></td>
            <td style="text-align:right"><?php echo $row['taxable_amount']; ?></td>
            <td><?php echo $row['sgst_percent']; ?></td>
            <td style="text-align:right"><?php echo $row['sgst_amount']; ?></td>
            <td><?php echo $row['cgst_percent']; ?></td>
            <td style="text-align:right"><?php echo $row['cgst_amount']; ?></td>
            <td style="text-align:right"><?php echo $row['total_amount']; ?></td>
          </tr>
        <?php } ?>

        <tr>
            <td colspan=5 style="text-align:right"> <?php echo $tot_qty; ?></td>
            <td colspan=3 style="text-align:right"> <?php echo number_format($tot_discount_amount,2); ?></td>
            <td style="text-align:right"> <?php echo number_format($tot_taxable_amount,2); ?></td>
            <td colspan=2 style="text-align:right"> <?php echo number_format($tot_sgst_amount,2); ?></td>
            <td colspan=2 style="text-align:right"> <?php echo number_format($tot_cgst_amount,2); ?></td>
            <td style="text-align:right"> <?php echo number_format($tot_total_amount,2); ?></td>
        </tr>
        <tr>
            <input type="hidden" name="tot_qty" value="<?php echo $tot_qty; ?>">
            <input type="hidden" name="tot_discount_amount" value="<?php echo $tot_discount_amount; ?>">
            <input type="hidden" name="tot_taxable_amount" value="<?php echo $tot_taxable_amount; ?>">
            <input type="hidden" name="tot_sgst_amount" value="<?php echo $tot_sgst_amount; ?>">
            <input type="hidden" name="tot_cgst_amount" value="<?php echo $tot_cgst_amount; ?>">
            <input type="hidden" name="tot_total_amount" value="<?php echo $tot_total_amount; ?>">
            <input type="hidden" name="tot_records" value="<?php echo $sno; ?>">
          </tr>
          <tr>
            <td colspan="8"></td>
            <td colspan="2">Card: <input type="text" class="form-control" id="card_amount" name="card_amount" placeholder="" autocomplete="off" onkeypress="return isNumberKey(event)" onkeyUp="chk_avail_qty()"></td>
            <td colspan="2">Cash: <input type="text" class="form-control" id="cash_amount" name="cash_amount" placeholder="" autocomplete="off" onkeypress="return isNumberKey(event)" onkeyUp="chk_avail_qty()"></td>
            <td colspan="2">Online: <input type="text" class="form-control" id="online_amount" name="online_amount" placeholder="" autocomplete="off" onkeypress="return isNumberKey(event)" onkeyUp="chk_avail_qty()"></td>
          </tr>
         <tr>
        <td colspan="14" style="text-align:right"><button class="btn btn-primary" type="submit">Submit</button></td>
        </tr>
      </tbody>
    </table>
  </div>

  <?php
}
}
?>