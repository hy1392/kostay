<?
  include 'dbconnect.php';
  extract($_POST);
  $query = "delete from message where idx=".$target.";";
  $result = mysqli_query($conn, $query);
  mysqli_close($conn);
?>
