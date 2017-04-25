<?php
  include 'dbconnect.php';
  extract($_POST);
  if(isset($_POST['target'])){
    $query = "update users set `flag`=2  where email = '".$target."'";
    $result = mysqli_query($conn, $query);
    $_SESSION['flag']=2;
    return;
  }
  $query = "update users set username='".$name."', pwd='".$pwd."'  where email = '".$email."'";
  $result = mysqli_query($conn, $query);
  $_SESSION['name']=$name;
  mysqli_close($conn);
?>
