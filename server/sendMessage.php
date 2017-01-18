<?
  include 'dbconnect.php';
  extract($_POST);
  $query = "insert into `message` (`sent_id`, `title`, `receiver`, `content`, `sent_time`) values ('".$_SESSION['id']."','".$title."', '".$target."', '".$content."', now());";
  $result = mysqli_query($conn, $query);
  mysqli_close($conn);
?>
