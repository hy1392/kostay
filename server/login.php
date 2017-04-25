<?php
  include 'dbconnect.php';
  extract($_POST);
  $id   = $vid;
  $pwd  = $vpwd;

  $return = array();

  $query = "select * from users where email = '".$id."'"."and pwd = '".$pwd."'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) === 0){
      array_push($return, "사용자 정보를 찾을 수 없습니다. 아이디, 비밀번호를 확인하시고 다시 시도해 주세요.");
  }
  else{
    $row = mysqli_fetch_assoc($result);
    $name = $row['username'];
    $flag = $row['flag'];

    if($flag == 0){
      array_push($return, $name."님. 가입 승인 대기 상태입니다. 가입 완료 후 Kostay 이용이 가능합니다.");
      echo json_encode($return);
      return;
    }
    else {

      if($flag == 1)      $_SESSION['flag'] = 1;
      else if($flag == 2) $_SESSION['flag'] = 2;
      else if($flag == 3) $_SESSION['flag'] = 3;

      $_SESSION['id'] = $id;
      $_SESSION['name'] = $name;

    }
    array_push($return, $name."님. Kostay에 오신걸 환영합니다.");
    if($flag == 2)      array_push($return, 2);
    else if($flag == 3) array_push($return, 3);

    echo json_encode($return);
      return;
  }
echo json_encode($return);
?>
