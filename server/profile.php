<?php
  include 'dbconnect.php';
  extract($_POST);
  $file=$_FILES["file"];
  $description = $_POST['description'];
  if(0<$file['error']){
    echo "업로드할 파일이 잘못되었습니다. 파일을 확인하시고 다시 첨부해 주세요";
  }
  else{
    $filename="test.png";
    move_uploaded_file($file['tmp_name'], 'user_profile/'.$filename);
  }
  $loc='user_profile/'.$filename;

  $query = "select * from user_profile where email='".$_SESSION['id']."'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)===1){
    $query = "update user_profile set `img`='".$loc."', `description`='".$description."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
  }
  else{
    $query = "insert into user_profile (`email`, `img`, `description`) values('".$_SESSION['id']."','".$loc."','".$description."')";
    $result = mysqli_query($conn, $query);
  }

  mysqli_close($conn);
?>
