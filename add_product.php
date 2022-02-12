<?php
include('header.php');

$sql_select = 'SELECT * FROM tbl_product_category';
$result2 = mysqli_query($conn, $sql_select);
$result1 = mysqli_query($conn, $sql_select);

if (isset($_GET['delete'])) {
  $id = $_GET["delete"];
  $delete = true;
  $sql = "DELETE FROM `tbl_product` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['productEdit'])) {
    // Update the record
    $id = $_POST["snoEdit"];
    $category_id = $_POST["category_idEdit"];
    $name = $_POST["productEdit"];
    $rate = $_POST["mrpEdit"];
    $qty = $_POST["qtyEdit"];

    // Sql query to be executed
    $sql = "UPDATE `tbl_product` SET `category_id` = '$category_id',`name` = '$name', `rate` = '$rate', `qty` = '$qty' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      $update = true;
    } else {
      echo "We could not update the record successfully";
    }
  } else {
    $category_id = $_POST['category_id'];
    $productName = $_POST['productName'];
    $mrp = $_POST['mrp'];
    $qty = $_POST['qty'];

    // Sql query to be executed
    $sql = "INSERT INTO tbl_product (category_id,name,rate,qty) VALUES ('$category_id','$productName','$mrp','$qty')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $insert = true;
    } else {
      echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
    }
  }
}
?>

<style>
  .select2-selection__rendered {
    line-height: 35px !important;
  }

  .select2-container .select2-selection--single {
    height: 40px !important;
  }

  .select2-selection__arrow {
    height: 40px !important;
  }
</style>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit this Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div class="modal-body">
          <input type="hidden" name="snoEdit" id="snoEdit">
          <div class="form-group">
            <label for="category">Select Category</label>
            <select id="category_idEdit" name="category_idEdit" class="form-control">
              <?php
              mysqli_data_seek($result1, 0);
              while ($row = mysqli_fetch_assoc($result1)) { ?>
                <option value='<?php echo $row['id']; ?>'><?php echo $row['category']; ?></option>
              <?php } ?>
              <option>Select</option>
            </select>
          </div>
          <div class="form-group">
            <label for="category">Product Name</label>
            <input type="text" class="form-control" id="productEdit" name="productEdit" autocomplete="off" aria-describedby="emailHelp">
          </div>
          <div class="form-group">
            <label for="category">MRP</label>
            <input type="text" class="form-control" id="mrpEdit" name="mrpEdit" autocomplete="off" aria-describedby="emailHelp" onkeypress="return isNumberKey(event)">
          </div>
          <div class="form-group">
            <label for="category">Qty</label>
            <input type="text" class="form-control" id="qtyEdit" name="qtyEdit" autocomplete="off" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="modal-footer d-block mr-auto">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php
if ($insert) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your product has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
}
?>
<?php
if ($delete) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your product has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
}
?>
<?php
if ($update) {
  echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your product has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
}
?>
<div class="container my-4">
  <h2>Add Product</h2>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="form-group">
      <label for="category">Select Category</label>
      <select id="category_id" name="category_id" class="form-control" required>
        <?php
        mysqli_data_seek($result2, 0);
        while ($row = mysqli_fetch_assoc($result2)) { ?>
          <option value='<?php echo $row['id']; ?>'><?php echo $row['category']; ?></option>
        <?php } ?>
        <option>Select</option>
      </select>
    </div>
    <div class="form-group">
      <label for="category">Product Name</label>
      <input type="text" class="form-control" id="productName" name="productName" required autocomplete="off" aria-describedby="emailHelp">
    </div>
    <div class="form-group">
      <label for="category">MRP</label>
      <input type="text" class="form-control" id="mrp" name="mrp" required autocomplete="off" aria-describedby="emailHelp" onkeypress="return isNumberKey(event)">
    </div>
    <div class="form-group">
      <label for="category">Qty</label>
      <input type="text" class="form-control" id="qty" name="qty" required autocomplete="off" aria-describedby="emailHelp">
    </div>
    <button type="submit" class="btn btn-primary">Add Product</button>
  </form>
</div>

<div class="container my-4">
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">S.No</th>
        <th scope="col">Category</th>
        <th scope="col">Product Name</th>
        <th scope="col">MRP</th>
        <th scope="col">Qty</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql_select = 'SELECT tbl_product.*, tbl_product_category.category FROM tbl_product INNER JOIN tbl_product_category ON tbl_product_category.id = tbl_product.category_id ORDER BY tbl_product.id DESC';
      $result = mysqli_query($conn, $sql_select);
      $sno = 0;
      while ($row = mysqli_fetch_assoc($result)) {
        $sno = $sno + 1; ?>
        <tr>
          <th scope='row'><?php echo $sno ?></th>
          <td><?php echo $row['category']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['rate']; ?></td>
          <td><?php echo $row['qty']; ?></td>
          <td style="display:none"><?php echo $row['category_id']; ?></td>
          <td> <button class='edit btn btn-sm btn-primary' id="<?php echo $row['id'] ?>">Edit</button> <button class='delete btn btn-sm btn-primary' id="<?php echo $row['id'] ?>">Delete</button> </td>
        </tr>
      <?php }
      ?>


    </tbody>
  </table>
</div>
<?php
require_once('footer.php');
?>
<script>
  $(document).ready(function() {
    $('#myTable').DataTable();

  });
</script>

<script>
  $("#category_id").select2({
    placeholder: "Select",
    allowClear: true
  });
</script>
<script>
  edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element) => {
    element.addEventListener("click", (e) => {
      //console.log("edit ");
      tr = e.target.parentNode.parentNode;
      category = tr.getElementsByTagName("td")[4].innerText;
      product = tr.getElementsByTagName("td")[1].innerText;
      rate = tr.getElementsByTagName("td")[2].innerText;
      qty = tr.getElementsByTagName("td")[3].innerText;
      //console.log(category);
      category_idEdit.value = category;
      productEdit.value = product;
      mrpEdit.value = rate;
      qtyEdit.value = qty;
      snoEdit.value = e.target.id;
      //console.log(e.target.id)
      $('#editModal').modal('toggle');
    })
  })

  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element) => {
    element.addEventListener("click", (e) => {
      sno = e.target.id;
      //console.log(sno);
      if (confirm("Are you sure you want to delete this product!")) {
        //console.log("yes");
        window.location = `add_product.php?delete=${sno}`;
        // TODO: Create a form and use post request to submit a form
      } else {
        console.log("no");
      }
    })
  })
</script>