<?php
  include 'dbconnect.php';
  extract($_POST);
  if(!isset($_SESSION['id'])){
    echo "찜하기 기능을 사용하기 위해서는 먼저 로그인해 주세요.";
    return;
  }
  $query = "select * from user_wish_list where email='".$_SESSION['id']."' and house_id='".$target."'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)===1) echo "이미 찜리스트에 추가한 하우스 입니다.";
  else {
    $query = "insert into user_wish_list (`email`, `house_id`) values ('".$_SESSION['id']."', '".$target."')";
    $result = mysqli_query($conn, $query);
    echo "하우스가 찜리스트에 추가되었습니다.";
  }
  mysqli_close($conn);
?>
