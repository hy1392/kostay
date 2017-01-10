<?php
  include 'dbconnect.php';

  $name   = $_GET['name'];
  $email  = $_GET['email'];
  $pwd    = $_GET['pwd'];
  $flag    = $_GET['flag'];

  $data_stream = "'".$name."','".$email."','".$pwd."','".$flag."'";
  $query = "insert into users(username, email, pwd, flag) values(".$data_stream.")";
  $result = mysqli_query($conn, $query);

  if($result){
    # code...
    ?>
    <script>
      alert("Kostay에 오신걸 환영합니다.");
      location.href = "../index.html";
    </script>
    <?

  }
  else {
    # code...
    ?>
    <script>
      alert("회원가입 오류! 잠시 후에 다시 시도해 주시기 바랍니다.");
      //location.href = "../index.html";
    </script>
    <?
  }
  mysqli_close($conn);
?>
