<?php 
require_once('header.php');
ob_start();
session_start();

if ($_SESSION['user_id']) {
    header("Location: sale.php");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    if (isset( $_POST['email'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
      
        $sql = "SELECT * FROM tbl_user WHERE email = '$email' and password = '$password'";
        $result_user = mysqli_query($conn, $sql);
        $data_user = mysqli_fetch_assoc($result_user);
        $num_rows = mysqli_num_rows($result_user);
        if($num_rows>0) {
            $_SESSION['username'] = $data_user['username'];
            $_SESSION['user_id'] = $data_user['id'];

            
            header("Location: sale.php");
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Oops!</strong> Invalid credentials. Please try again.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>×</span>
                </button>
            </div>";
        }
    }
}
?>

<section class="ftco-section">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-7 col-lg-5">
<div class="login-wrap p-4 p-md-5">
<div class="icon d-flex align-items-center justify-content-center">
<span class="fa fa-user-o"></span>
</div>
<h3 class="text-center mb-4">Sign In</h3>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" class="login-form" method="POST">
<div class="form-group">
<input type="text" class="form-control rounded-left" name="email" placeholder="email" required>
</div>
<div class="form-group d-flex">
<input type="password" class="form-control rounded-left" name="password" placeholder="Password" required>
</div>
<div class="form-group">
<button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</section>


