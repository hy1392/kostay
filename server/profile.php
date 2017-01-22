<?php
  include 'dbconnect.php';
  extract($_POST);

  $query = "select * from user_profile where email='".$_SESSION['id']."'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)===1){
    $query = "update user_profile set `description`='".$description."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
    echo "프로필 등록 성공!";
  }
  else{
    $query = "insert into user_profile (`email`, `img`, `description`) values('".$_SESSION['id']."','user_profile/sample.jpg','".$description."')";
    $result = mysqli_query($conn, $query);
    echo "프로필 등록 성공!";
  }

/*
  if(0<$_FILES['file']['error']){
    echo "업로드할 파일이 잘못되었습니다. 파일을 확인하시고 다시 첨부해 주세요";
  }
  else{
    $filename=date('Y/m/d')."_".date('H:i:s').$_FILES['file']['error'];
    move_uploaded_file($_FILES['file']['tmp_name'], 'user_profile/'.$filename);
  }
  $loc='user_profile/'.$_FILES['file']['name'];
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
  }*/

  mysqli_close($conn);
?>
