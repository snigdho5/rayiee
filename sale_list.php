<?php  
include('header.php');

  $from_date = isset($_POST['from_date']) ? date('Y-m-d',strtotime($_POST['from_date'])) : '';
  $to_date = isset($_POST['to_date']) ? date('Y-m-d',strtotime($_POST['to_date'])) : '';

  $sql_select = "SELECT tbl_sale.* FROM tbl_sale ";
 
  if($from_date) {
    $sql_select .= "WHERE created_at BETWEEN '" . $from_date . "' AND  '" . $to_date . "'";
  } 
  
  $sql_select .= " ORDER BY id DESC";

  $result = mysqli_query($conn, $sql_select);
?>

<div class="container my-4">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  <div class="form-row">
    <div class="col-md-2 mb-3">
      <label for="validationDefault05">From Date: </label>
    </div>
    <div class="col-md-4 mb-3">
      <input type="date" class="form-control" id="from_date" name="from_date" value="<?php echo $from_date; ?>" placeholder="Add From Date">
    </div>
    <div class="col-md-2 mb-3"> 
      <label for="validationDefault05">To Date: </label>
    </div>
    <div class="col-md-4 mb-3">
      <input type="date" class="form-control" id="to_date" name="to_date" value="<?php echo $to_date; ?>" placeholder="Add To Date">
    </div>
  </div>
  <div class="form-row">
  <button class="btn btn-primary" type="submit">Search</button>
  </div>
</form>
</div>


<div class="container my-4">
    <table class="table" id="myTable">
      <thead>
      <button class="btn btn-primary" onclick="$('#exptable').tblToExcel();" style="float:right;margin-bottom: 10px;">Export</button>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Invoice Name</th>
          <th scope="col">Sale Date</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Taxable Amount</th>
          <th scope="col">SGST Amount</th>
          <th scope="col">CGST Amount</th>
          <th scope="col">Total Amount</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)) { 
            $sno = $sno + 1; ?>
          <tr>
            <th scope='row'><?php echo $sno ?></th>
            <td><?php echo $row['invoice_no']; ?></td>
            <td><?php echo date('d/m/Y',strtotime($row['created_at'])); ?></td>
            <td><?php echo $row['cust_name']; ?></td>
            <td><?php echo $row['tax_amount']; ?></td>
            <td><?php echo $row['sgst_amount']; ?></td>
            <td><?php echo $row['cgst_amount']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
            <td> <a class='edit btn btn-sm btn-primary' href="javacript:void(0)" onclick="get_invoice(<?php echo $row['id']; ?>)"> Invoice </a>  </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <table class="table table-bordered table-striped" id="exptable" style="display:none">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Invoice Name</th>
          <th scope="col">Sale Date</th>
          <th scope="col">Customer Name</th>
          <th scope="col">Taxable Amount</th>
          <th scope="col">SGST Amount</th>
          <th scope="col">CGST Amount</th>
          <th scope="col">Total Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sno = 0;
          mysqli_data_seek($result,0);
          while($row = mysqli_fetch_assoc($result)) { 
            $sno = $sno + 1; ?>
          <tr>
            <th scope='row'><?php echo $sno ?></th>
            <td><?php echo $row['invoice_no']; ?></td>
            <td><?php echo date('d/m/Y',strtotime($row['created_at'])); ?></td>
            <td><?php echo $row['cust_name']; ?></td>
            <td><?php echo $row['tax_amount']; ?></td>
            <td><?php echo $row['sgst_amount']; ?></td>
            <td><?php echo $row['cgst_amount']; ?></td>
            <td><?php echo $row['total_amount']; ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
<?php 
require_once('footer.php');
?>

<script src="tableToExcel.js"></script>
<script>

$(document).ready(function () {
      $('#myTable').DataTable();

    });
    
  function get_invoice(id) {
    window.open("invoice.php?id="+id, "", "width=1600,height=1200");
  }
</script>

