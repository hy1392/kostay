<?php
  include 'dbconnect.php';
  extract($_POST);

  if(0<$_FILES['file']['error']){
    echo "업로드할 파일이 잘못되었습니다. 파일을 확인하시고 다시 첨부해 주세요";
  }
  else{
    $filename=$_SESSION['id'];
    move_uploaded_file($_FILES['file']['tmp_name'], 'user_profile/'.$filename);
  }
  $loc='user_profile/'.$filename;
  if(isset($condition)){
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
  }
  else{
    $query = "update users set username='".$name."', pwd='".$pwd."'  where email = '".$email."'";
    $result = mysqli_query($conn, $query);
  }

  mysqli_close($conn);
?>
