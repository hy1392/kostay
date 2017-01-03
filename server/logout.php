<?php
  session_start();
  ?>
  <script>
    alert("<?php echo $_SESSION['name'] ?>님 Kostay에서 로그아웃 하셨습니다.");
  </script>
  <?
  session_destroy();
  ?>
  <script>
    location.href = "../index.html";
  </script>
