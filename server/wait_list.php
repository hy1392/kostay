<?php
  include 'dbconnect.php';
  extract($_POST);
  if($condition=="신청"){
    $query = "select * from user_movein_list where email='".$_SESSION['id']."' and house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===1) echo "이미 찜리스트에 추가한 하우스 입니다.";
    else {
      $query = "insert into user_movein_list (`email`, `house_id`) values ('".$_SESSION['id']."', '".$target."')";
      $result = mysqli_query($conn, $query);
      echo "하우스가 찜리스트에 추가되었습니다.";
    }
  }
  elseif($condition=="대기"){
    $query = "select * from user_wait_list where email='".$_SESSION['id']."' and house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===1) echo "이미 찜리스트에 추가한 하우스 입니다.";
    else {
      $query = "insert into user_wait_list (`email`, `house_id`) values ('".$_SESSION['id']."', '".$target."')";
      $result = mysqli_query($conn, $query);
      echo "하우스가 찜리스트에 추가되었습니다.";
    }

  }
  mysqli_close($conn);
?>
