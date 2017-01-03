<?php
  include 'dbconnect.php';

  $id   = $_GET['id'];
  $pwd  = $_GET['pwd'];

  $query = "select * from users where email = '".$id."'"."and pwd = '".$pwd."'";
  if(!$result = mysqli_query($conn, $query)){
    ?>
    <script>
      alert("사용자 정보를 찾을 수 없습니다. 메인페이지로 이동합니다.");
      location.href = "../index.html";
    </script>
    <?
  }
  else{
    $row = mysqli_fetch_assoc($result);
    $name = $row['username'];
    $flag = $row['flag'];

    if($flag == 0){
      ?>
      <script>
        alert(" <?php echo $name ?> 님. 가입 승인 대기 상태입니다. 가입 완료 후 Kostay 이용이 가능합니다.");
        location.href = "../index.html";
      </script>
      <?
    }
    else {

      if($flag == 1)      $_SESSION['flag'] = 1;
      else if($flag == 2) $_SESSION['flag'] = 2;
      else if($flag == 3) $_SESSION['flag'] = 3;

      $_SESSION['id'] = $id;
      $_SESSION['name'] = $name;

    }
    ?>
    <script>
      alert(" <?php echo $name ?> 님. Kostay에 오신걸 환영합니다.");
      location.href = "../index.html";
    </script>
    <?
  }

?>
