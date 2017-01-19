<?php
  include 'dbconnect.php';
  extract($_POST);

  $query = "update users set username='".$name."', pwd='".$pwd."'  where email = '".$email."'";
  $result = mysqli_query($conn, $query);
  mysqli_close($conn);
?>
