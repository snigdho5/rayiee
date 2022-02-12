<?php
$servername = "localhost";
$username = "u193686736_rayiee";
$password = "0*nMdEtyes";
$dbname = "u193686736_rayiee";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>