<?php
  include 'dbconnect.php';
  extract($_POST);
  if($condition=="신청"){
    if($visit_date!="" && $visit_time!="") $visit_date_modified = $visit_date." ".$visit_time;
    else $visit_date_modified=null;
    $query = "insert into user_movein_list (`email`,`gender`,`nationality`,`age`,`hp`,`contact_email`,`notify`,`visit_date`,`movein_date`,`skip_visit`,`description`,`house_id`,`bed_id`, `time`)
    values ('".$_SESSION['id']."', '".$gender."', '".$nationality."', '".$age."','".$hp."','".$contact_email."','".$notify."','".$visit_date_modified."','".$movein_date."','".$skip_visit."','".$description."','".$house_id."','".$bed_id."', now());";
    $result = mysqli_query($conn, $query);
    echo "입주신청을 요청하였습니다.";
  }
  elseif($condition=="대기"){
    $query = "insert into user_wait_list (`email`,`gender`,`nationality`,`age`,`hp`,`contact_email`,`notify`,`movein_date`,`description`,`house_id`,`bed_id`, `time`)
    values ('".$_SESSION['id']."', '".$gender."', '".$nationality."', '".$age."','".$hp."','".$contact_email."','".$notify."','".$movein_date."','".$description."','".$house_id."','".$bed_id."', now());";
    $result = mysqli_query($conn, $query);
    echo "대기신청을 요청하였습니다.";
  }
  elseif($condition=="get"){

  }
  else{
    echo "처리도중 에러가 발생하였습니다. 잠시후 다시 시도해주세요.";
  }
  mysqli_close($conn);
?>
