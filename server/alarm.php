<?php
  include 'dbconnect.php';
  extract($_POST);
  if($condition=="getId"){
    $i=0;
    while(1){
      $tmp = $_SESSION['id']."_".$i;
      $query = "select * from alarm where alarm_id='".$tmp."'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result)===0) break;
      $i=$i+1;
    }
    echo $tmp;
      return false;
  }
  else if($condition=="save"){
    $query = "select * from alarm where alarm_id='".$alarm_id."'";
    $result = mysqli_query($conn, $query);
    
    // if(mysqli_num_rows($result)===0){
    //   $finalQuery = "insert into alarm (`user_id`, `alarm_id`, `alarm_title`, `alarm_loc`, `alarm_param`, `address`,`gender`,`house_type`,`type`,`min_rent`,`max_rent`,`person`,`park`,`date`,`date_condition`, `contact`, `cont`, `register_time`)
    //   values ('".$_SESSION['id']."', '".$alarm_id."', '".$alarm_title."', '".$alarm_loc."', '".$alarm_param."','".$address."','".$gender."','".$house_type."','".$type."',".$min_rent.",".$max_rent.",".$person.",'".$park."',".$date.", '".$date_condition."', '".$contact."', '".$cont."', '".$register_time."')";
    // }
    // else{
    //   $finalQuery = "update alarm set `address`='".$address."',`gender`='".$gender."',`house_type`='".$house_type."',`type`='".$type."',`min_rent`=".$min_rent.",`max_rent`=".$max_rent.",`person`=".$person.",`park`='".$park."',`date`=".$date.",`date_condition`='".$date_condition."', `contact`='".$contact."', `register_time`='".$register_time."'
    //   where alarm_id='".$alarm_id."';";
    // }
    if(mysqli_num_rows($result)===0){
       $finalQuery = "insert into alarm (`user_id`, `alarm_id`, `alarm_title`, `alarm_loc`, `alarm_param`, `address`,`gender`,`house_type`,`type`,`min_rent`,`max_rent`,`person`,`park`,`date`,`date_condition`, `contact`, `cont`, `register_time`) values ('".$_SESSION['id']."', '".$alarm_id."', '".$alarm_title."', '".$alarm_loc."', '".$alarm_param."','".$address."','".$gender."','".$house_type."','".$type."',".$min_rent.",".$max_rent.",1,'".$park."','".$date."', '".$date_condition."', '".$contact."', '".$cont."', now())";
     }
     else{
       $finalQuery = "update alarm set `alarm_title`='".$alarm_title."', `alarm_loc`='".$alarm_loc."', `alarm_param`='".$alarm_param."', `address`='".$address."',`gender`='".$gender."',`house_type`='".$house_type."',`type`='".$type."',`min_rent`=".$min_rent.",`max_rent`=".$max_rent.",`person`=1,`park`='".$park."',`date`='".$date."',`date_condition`='".$date_condition."', `cont`='".$cont."', `contact`='".$contact."' where alarm_id='".$alarm_id."';";
     }
    $finalReqult = mysqli_query($conn,$finalQuery);
      if($finalReqult) echo "저장 성공!";
      else echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인해 주세요.";
  }
  else if($condition=="delete"){
    $finalQuery = "delete from alarm where `alarm_id` = '".$alarm_id."'";
    $query = mysqli_query($conn, $finalQuery);
  }
  else if($condition=="modify"){
      $finalQuery = "select * from alarm where alarm_id='".$target."'";
      $finalResult = mysqli_query($conn, $finalQuery);
      $finalRow = mysqli_fetch_array($finalResult);
      $return = "";
      for($i=0; $i<17; $i++){
          $return.=",".$finalRow[$i];
      }
      echo $return;
  }
elseif($condition=="con"){
    $contQuery = "select * from alarm where alarm_id='".$target."'";
    $contResult = mysqli_query($conn, $contQuery);
    $contRow = mysqli_fetch_array($contResult);
    if($contRow['cont']==1)
        $query = "update alarm set `cont`= '0' where alarm_id='".$target."';";
    else
        $query = "update alarm set `cont`= '1' where alarm_id='".$target."';";
    echo $query;
    $result = mysqli_query($conn, $query);
  }
elseif($condition=="simplesave"){
    $query = "select * from alarm where alarm_id='".$alarm_id."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===0){
       $finalQuery = "insert into alarm (`user_id`, `alarm_id`, `alarm_title`, `address`,`gender`,`type`, `contact`, `cont`, `register_time`) values ('".$_SESSION['id']."', '".$alarm_id."', '간편알림','".$address."','".$gender."','".$type."', '".$_SESSION['id']."', '".$cont."', now())";
     }
     else{
       $finalQuery = "update alarm set `address`='".$address."',`gender`='".$gender."',`type`='".$type."', `cont`='".$cont."' where alarm_id='".$alarm_id."';";
     }
    $finalReqult = mysqli_query($conn,$finalQuery);
      if($finalReqult) echo "저장 성공!";
      else echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인해 주세요.";
  }
?>