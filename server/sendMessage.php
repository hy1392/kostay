<?
  include 'dbconnect.php';
  extract($_POST);
  $query = "insert into `message` (`sent_id`, `title`, `receiver`, `content`, `rdeleted`, `sdeleted`, `sent_time`) values ('".$_SESSION['id']."','".$title."', '".$target."', '".$content."', 1, 1, now());";
  $result = mysqli_query($conn, $query);
  mysqli_close($conn);
?>
