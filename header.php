<?php 
require_once('db.php');
session_start();
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="select2.min.css" />
  <title>Rayie - Collection</title>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Rayie</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if($_SESSION['username']) { ?>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="sale.php">Sale</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="user.php">User</a>
        </li>
      </ul>
       
      <label style="color:white; padding-right:10px">Hi, <?php echo $_SESSION['username']; ?></label>
        <a class="btn btn-outline-success" href="logout.php">Logout</a>

    </div>
    <?php } ?>
  </nav>