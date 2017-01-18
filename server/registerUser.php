<?php
  include 'dbconnect.php';

  $name   = $_POST['name'];
  $email  = $_POST['email'];
  $pwd    = $_POST['pwd'];
  $flag    = $_POST['flag'];

  $query = "select * from users where email = '".$email."'"."and pwd = '".$pwd."'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)>0) echo "이미 사용중인 아이디입니다. 다른 이메일 주소를 사용해 주세요";
  else{
    $data_stream = "'".$name."','".$email."','".$pwd."','".$flag."'";
    $query = "insert into users(username, email, pwd, flag) values(".$data_stream.")";
    $result = mysqli_query($conn, $query);

    if($result){
      # code...
      $query = "select * from users where email = '".$email."'"."and pwd = '".$pwd."'";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $name = $row['username'];
      $flag = $row['flag'];
      if($flag == 1)      $_SESSION['flag'] = 1;
      else if($flag == 2) $_SESSION['flag'] = 2;
      else if($flag == 3) $_SESSION['flag'] = 3;

      $_SESSION['id'] = $email;
      $_SESSION['name'] = $name;
      echo "Kostay에 오신걸 환영합니다.";

    }
    else {
        echo "회원가입 오류! 잠시 후에 다시 시도해 주시기 바랍니다.";
    }
  }
  mysqli_close($conn);
?>
