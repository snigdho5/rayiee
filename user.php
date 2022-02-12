<?php
include('header.php');

if (isset($_GET['delete'])){
  $id = $_GET["delete"];
  $delete = true;
  $sql = "DELETE FROM `tbl_user` WHERE `id` = $id";
  $result = mysqli_query($conn, $sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if (isset( $_POST['usernameEdit'])){
    // Update the record
      $id = $_POST["snoEdit"];
      $username = $_POST["usernameEdit"];
      $email = $_POST["emailEdit"];

    // Sql query to be executed
    $sql = "UPDATE `tbl_user` SET `username` = '$username', `email` = '$email' WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    if($result){
      $update = true;
    } else {
      echo "We could not update the record successfully";
    }
  } else {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Sql query to be executed
    $sql = "INSERT INTO tbl_user (username,email,password) VALUES ('$username','$email','$password')";
    $result = mysqli_query($conn, $sql);

    if($result){
        $insert = true;
    } else {
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
          <h5 class="modal-title" id="editModalLabel">Edit this User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">
            <div class="form-group">
              <label for="username">User Name</label>
              <input type="text" class="form-control" id="usernameEdit" name="usernameEdit" autocomplete="off" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="emailEdit" name="emailEdit" autocomplete="off" aria-describedby="emailHelp">
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
    <strong>Success!</strong> User has been inserted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> User has been deleted successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> User has been updated successfully
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
      <span aria-hidden='true'>×</span>
    </button>
  </div>";
  }
  ?>
  <div class="container my-4">
    <h2>Add Product</h2>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="form-group">
            <label for="username">User Name</label>
            <input type="text" class="form-control" id="username" name="username" autocomplete="off" required aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required autocomplete="off" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required autocomplete="off" aria-describedby="emailHelp">
        </div>
      <button type="submit" class="btn btn-primary">Add User</button>
    </form>
  </div>

  <div class="container my-4">
    <table class="table" id="myTable">
      <thead>
        <tr>
          <th scope="col">S.No</th>
          <th scope="col">Username</th>
          <th scope="col">Email</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
          $sql_select = 'SELECT * FROM tbl_user ORDER BY id DESC';
          $result = mysqli_query($conn, $sql_select);
          $sno = 0;
          while($row = mysqli_fetch_assoc($result)) { 
            $sno = $sno + 1; ?>
          <tr>
            <th scope='row'><?php echo $sno ?></th>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['email']; ?></td>
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
        //console.log("edit ");
        tr = e.target.parentNode.parentNode;
        username = tr.getElementsByTagName("td")[0].innerText;
        email = tr.getElementsByTagName("td")[1].innerText;
        //console.log(category);
        usernameEdit.value = username;
        emailEdit.value = email;
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
        if (confirm("Are you sure you want to delete this user!")) {
          //console.log("yes");
          window.location = `user.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })
  </script>