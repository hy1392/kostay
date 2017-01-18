<?php
  session_start();
  echo $_SESSION['name']."님 Kostay에서 로그아웃 하셨습니다.";
  session_destroy();
?>
