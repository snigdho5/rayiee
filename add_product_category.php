<?php  
include('header.php');

if(isset($_GET['delete'])){
  $id = $_GET["delete"];
  $delete = true;
  $sql = "DELETE FROM `tbl_product_category` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
if (isset( $_POST['categoryEdit'])){
  // Update the record
    $id = $_POST["snoEdit"];
    $category = $_POST["categoryEdit"];

  // Sql query to be executed
  $sql = "UPDATE `tbl_product_category` SET `category` = '$category' WHERE id = $id";
  $result = mysqli_query($conn, $sql);
  if($result){
    $update = true;
}
else{
    echo "We could not update the record successfully";
}
}
else{
    $category = $_POST["category"];

  // Sql query to be executed
  $sql = "INSERT INTO `tbl_product_category` (`category`) VALUES ('$category')";
  $result = mysqli_query($conn, $sql);

   
  if($result){ 
      $insert = true;
  }
  else{
      echo "The record was not inserted successfully because of this error ---> ". mysqli_error($conn);
  } 
}
}
?>


  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="category">Edit category</label>
              <input type="text" class="form-control" id="categoryEdit" name="categoryEdit" autocomplete="off" aria-describedby="emailHelp">
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
  if($insert){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your category has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your category has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your category has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Add Product Category</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="form-group">
        <label for="category">Category Name</label>
        <input type="text" class="form-control" id="category" name="category" required autocomplete="off" aria-describedby="emailHelp">
      </div>
      <button type="submit" class="btn btn-primary">Add Category</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Category</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql_select = 'SELECT * FROM tbl_product_category ORDER BY id DESC';
          $result = mysqli_query($conn, $sql_select);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)) { 
            $sno = $sno + 1; ?>
          <tr>
            <th scope='row'><?php echo $sno ?></th>
            <td><?php echo $row['category']; ?></td>
            <td> <button class='edit btn btn-sm btn-primary' id="<?php echo $row['id'] ?>">Edit</button> <button class='delete btn btn-sm btn-primary' id="<?php echo $row['id'] ?>">Delete</button>  </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
<?php 
require_once('footer.php');
?>
  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();

    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        category = tr.getElementsByTagName("td")[0].innerText;
        console.log(category);
        categoryEdit.value = category;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })

    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        sno = e.target.id;
        //console.log(sno);
        if (confirm("Are you sure you want to delete this Category!")) {
          console.log("yes");
          window.location = `add_product_category.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>