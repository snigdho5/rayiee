<?php  
include('header.php');

$sql_select = 'SELECT * FROM tbl_product_category';
$result2 = mysqli_query($conn, $sql_select);
$user_id = $_SESSION["user_id"];

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

  $cust_name = $_POST['cust_name'];
  $cust_email = $_POST['cust_email'];
  $cust_mobile = $_POST['cust_mobile'];
  $cust_address = $_POST['cust_address'];

  $query = "SELECT max(id) as id FROM tbl_sale";
  $result = mysqli_fetch_assoc(mysqli_query($conn, $query));
  $data = $result['id'];
  $invoiceNo = '#RayieOrder'.($data+1);

  $sno = $_POST["tot_records"];

  $total_qty = $_POST["tot_qty"];
  $discount_amount = $_POST["tot_discount_amount"];
  $tax_amount = $_POST["tot_taxable_amount"];
  $sgst_amount = $_POST["tot_sgst_amount"];
  $cgst_amount = $_POST["tot_cgst_amount"];
  $total_amount = $_POST["tot_total_amount"];
  $cash_amount = $_POST["cash_amount"];
  $card_amount = $_POST["card_amount"];
  $online_amount = $_POST["online_amount"];
  
  $sql = "INSERT INTO tbl_sale (invoice_no,total_qty,discount_amount,tax_amount,sgst_amount,cgst_amount,total_amount,cust_name,cust_email,cust_mobile,cust_address,card_amount,cash_amount,online_amount,created_by) VALUES ('$invoiceNo','$total_qty','$discount_amount','$tax_amount','$sgst_amount','$cgst_amount','$total_amount','$cust_name','$cust_email','$cust_mobile','$cust_address','$card_amount','$cash_amount','$online_amount','$user_id')";
  $result = mysqli_query($conn, $sql);
  $sale_id = mysqli_insert_id($conn);

  if($result){ 
    $sql_temp_details = "SELECT * FROM tbl_sale_details_temp WHERE created_by ='$user_id'";
    $result_temp = mysqli_query($conn, $sql_temp_details);

    while($data_temp = mysqli_fetch_assoc($result_temp)) {
      $product_name = $data_temp["product_name"];
      $size = $data_temp["size"];
      $mrp = $data_temp["mrp"];
      $qty = $data_temp["qty"];
      $rate = $data_temp["rate"];
      $discount_percent = $data_temp["discount_percent"];
      $discount_amount = $data_temp["discount_amount"];
      $taxable_amount = $data_temp["taxable_amount"];
      $sgst_percent = $data_temp["sgst_percent"];
      $sgst_amount = $data_temp["sgst_amount"];
      $cgst_percent = $data_temp["cgst_percent"];
      $cgst_amount = $data_temp["cgst_amount"];
      $total_amount = $data_temp["total_amount"];

      $sql_sale_details = "INSERT INTO tbl_sale_details (sale_id,product_name,size,mrp,qty,rate,discount_percent,discount_amount,taxable_amount,sgst_percent,sgst_amount,cgst_percent,cgst_amount,total_amount,created_by) VALUES ('$sale_id','$product_name','$size','$mrp','$qty','$rate','$discount_percent','$discount_amount','$taxable_amount','$sgst_percent','$sgst_amount','$cgst_percent','$cgst_amount','$total_amount','$user_id')";
      mysqli_query($conn, $sql_sale_details);

      $sql_delete = "DELETE FROM tbl_sale_details_temp WHERE created_by ='$user_id'";
      mysqli_query($conn, $sql_delete);

      header("Location: sale_list.php");
    }

  } else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
} else {
  $sql_tempclean = "DELETE FROM tbl_sale_details_temp WHERE created_by ='$user_id'";
  mysqli_query($conn, $sql_tempclean);
}
?>


  <div class="container my-4">
  <a class="btn btn-primary" href="sale_list.php" style="float:right">View List</a>
    <h2>Add Customer Detail</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

    <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefault05">Customer Mobile</label>
      <input type="text" class="form-control" id="cust_mobile" name="cust_mobile" autocomplete="off" maxlength=10 placeholder="Mobile" required>
    </div>
    <div class="col-md-8 mb-3">
      <label for="validationDefault03">Customer Name</label>
      <input type="text" class="form-control" id="cust_name" name="cust_name" placeholder="Name" autocomplete="off" required>
    </div>

    </div>
    <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Customer Email</label>
      <input type="email" class="form-control" id="cust_email" name="cust_email" autocomplete="off" placeholder="Email">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">DOB</label>
      <input type="date" class="form-control" id="cust_dob" name="cust_dob" autocomplete="off" placeholder="DOB">
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationDefaultUsername">Anniversary</label>
      <input type="date" class="form-control" id="anniversary" name="anniversary" autocomplete="off" placeholder="Anniversary">
    </div>
    
  </div>
  <div class="form-row">
  <div class="col-md-12 mb-3">
    <label for="validationTextarea">Customer Address</label>
    
    <textarea class="form-control" id="cust_address" name="cust_address" placeholder="Customer Address" required></textarea>
  </div>
  </div>


  <!-- <div class="col-md-4 mb-3">
    <label for="validationDefault05">Payment Mode</label>
      <select id="mode" name="mode" class="form-control">
          <option value='cash'>Cash</option>
          <option value='card'>Card</option>
      </select>
    </div> -->

  <h2>Add Product Detail <span id="productError" style="color:red;font-size: 21px;font-weight: bold;"></span></h2> 
  <div class="form-row">
    <div class="col-md-4 mb-3">
    <label for="category">Add Product</label>
    <input type="text" class="form-control" id="productName" name="productName" autocomplete="off" >
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationDefaultUsername">Size</label>
      <input type="text" class="form-control" id="size" name="size" placeholder="" autocomplete="off">
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault03">Price</label>
      <input type="text" class="form-control" id="mrp" name="mrp" placeholder="" autocomplete="off" onkeypress="return isNumberKey(event)" onkeyUp="chk_avail_qty()">
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault04">Qty</label>
      <input type="text" class="form-control" id="qty" name="qty" placeholder="" autocomplete="off" onkeyUp="chk_avail_qty()">
      <input type="hidden" id="avail_qty" name="avail_qty" class="form-control">
      <span id="qtyError" style="color:red"></span>
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault05">Rate</label>
      <input type="text" class="form-control" id="rate" name="rate" placeholder="" readOnly autocomplete="off">
    </div>
    <div class="col-md-2 mb-3">
      <label for="validationDefault05">Taxable Amount</label>
      <input type="text" class="form-control" id="taxable_amount" name="taxable_amount" placeholder="" readOnly autocomplete="off">
    </div>
  </div>
  <div class="form-row">
      <div class="col-md-1 mb-3">
      <label for="validationDefault03">Discount %</label>
      <input type="text" class="form-control" id="discount_percent" name="discount_percent" placeholder="" value="0" autocomplete="off" onkeyUp="chk_avail_qty()">
    </div>
    <div class="col-md-2 mb-3">
      <label for="validationDefault04">Discount Amount</label>
      <input type="text" class="form-control" id="discount_amount" name="discount_amount" placeholder="" readOnly autocomplete="off">
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault05">GST %</label>
      <select id="gst_percent" name="gst_percent" class="form-control" onchange="chk_avail_qty()">
          <option value='0'>0 %</option>
          <option value='1'>1 %</option>
          <option value='3'>3 %</option>
          <option value='5'>5 %</option>
          <option value='7'>7 %</option>
          <option value='12' selected>12 %</option>
          <option value='18'>18 %</option>
          <option value='24'>24 %</option>
      </select>
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault05">SGST %</label>
      <input type="text" class="form-control" id="sgst_percent" name="sgst_percent" value="" placeholder="" readOnly autocomplete="off">
    </div>
    <div class="col-md-2 mb-3">
      <label for="validationDefault04">SGST Amount</label>
      <input type="text" class="form-control" id="sgst_amount" name="sgst_amount" placeholder="" readOnly autocomplete="off">
    </div>
    <div class="col-md-1 mb-3">
      <label for="validationDefault03">CGST %</label>
      <input type="text" class="form-control" id="cgst_percent" name="cgst_percent" value="" placeholder="" readOnly autocomplete="off">
    </div>
    <div class="col-md-2 mb-3">
      <label for="validationDefault04">CGST Amount</label>
      <input type="text" class="form-control" id="cgst_amount" name="cgst_amount" placeholder="" readOnly autocomplete="off">
    </div>
    <div class="col-md-2 mb-3">
      <label for="validationDefault05">Total Amount</label>
      <input type="text" class="form-control" id="total_amount" name="total_amount" placeholder="" readOnly autocomplete="off">
    </div>
  <button class="btn btn-primary" type="button" onclick="add_product_details()">Add</button>

  <div id="ajax_product_detail"></div>
</form>
  </div>
  <?php 
require_once('footer.php');
?>
<script>
  function chk_avail_qty() {
    let avail_qty = $('#avail_qty').val();
    let add_qty = $('#qty').val();
    let mrp = $('#mrp').val();
    let gst_percent = $('#gst_percent').val();

      $('#qtyError').text('');
      $('#productError').text('');
      let rate = add_qty*mrp;
      $('#rate').val(rate);
      if(gst_percent!='') {
        sgst_percent = parseFloat(gst_percent/2);
        $('#sgst_percent').val(sgst_percent);
        $('#cgst_percent').val(sgst_percent);

        $('#total_amount').val(rate);

        
        let discount_percent = $('#discount_percent').val();
        if (!discount_percent) {
          discount_percent = 0;
        }
        let discount_amount = ((parseFloat(discount_percent)*parseFloat(rate)) / 100);
        let total_amount = parseFloat(rate) - parseFloat(discount_amount);
        let sgst_amount = ((parseFloat(total_amount)*parseFloat(sgst_percent)) / 100);
        let taxable_amount = parseFloat(rate) - ((parseFloat(sgst_amount)*2) + parseFloat(discount_amount));
        

        $('#discount_amount').val((parseFloat(discount_amount)).toFixed(2));
        $('#sgst_amount').val((sgst_amount).toFixed(2));
        $('#cgst_amount').val((sgst_amount).toFixed(2));
        $('#taxable_amount').val((taxable_amount).toFixed(2));
        $('#total_amount').val((total_amount).toFixed(2));
      } else {
        $('#discount_amount').val('');
        $('#total_amount').val('');
        $('#sgst_percent').val('');
        $('#cgst_percent').val('');
        $('#sgst_amount').val('');
        $('#cgst_amount').val('');
        $('#taxable_amount').val('');
        $('#gst_percent').val('12');
        
      }
  }

  function add_product_details() {
    let product_name = $('#productName').val();
    let size = $('#size').val();
    let mrp = $('#mrp').val();
    let qty = $('#qty').val();
    let rate = $('#rate').val();
    let discount_percent = $('#discount_percent').val();
    let discount_amount = $('#discount_amount').val();
    let taxable_amount = $('#taxable_amount').val();
    let gst_percent = $('#gst_percent').val();
    let sgst_percent = $('#sgst_percent').val();
    let sgst_amount = $('#sgst_amount').val();
    let cgst_percent = $('#cgst_percent').val();
    let cgst_amount = $('#cgst_amount').val();
    let total_amount = $('#total_amount').val();
    
    if(product_name == 'Select' || size == '' || qty == '' || gst_percent == '') {
        $('#productError').text('Please add complete details..!!');
    } else {
        $('#productError').text('');
        $.ajax({
        url: "add_product_details.php",
        type: "POST",
        data: {
          product_name: product_name,
          size: size,
          mrp: mrp,
          qty: qty,
          rate: rate,
          discount_percent: discount_percent,
          discount_amount: discount_amount,
          taxable_amount: taxable_amount,
          sgst_percent: sgst_percent,
          sgst_amount: sgst_amount,
          cgst_percent: cgst_percent,
          cgst_amount: cgst_amount,
          total_amount: total_amount,
        },
        success: function(result){
          $('#productName').val('');
          $('#size').val('');
          $('#mrp').val('');
          $('#qty').val('');
          $('#rate').val('');
          $('#discount_percent').val('0');
          $('#discount_amount').val('');
          $('#taxable_amount').val('');
          $('#gst_percent').val('');
          $('#sgst_percent').val('');
          $('#cgst_percent').val('');
          $('#sgst_amount').val('');
          $('#cgst_amount').val('');
          $('#total_amount').val('');
          $("#ajax_product_detail").html(result);
        }
      });
    }
  }
</script>
  