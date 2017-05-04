<?
  include 'dbconnect.php';
  extract($_POST);
  $adQuery = "update search set pay=now() where house_id='".$target."'";
  $adResult = mysqli_query($conn, $adQuery);
?>
