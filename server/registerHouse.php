<?php
  include 'dbconnect.php';
  extract($_POST);
  if($condition=="getId"){
    $i=0;
    while(1){
      $tmp = $_SESSION['id']."_".$i;
      $query = "select * from house_main where house_id='".$tmp."'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result)===0) break;
      $i=$i+1;
    }
    echo $tmp;
  }
  elseif($condition=="register_1"){
    if($p1=="" ||$p2=="" ||$p3==""||$p4==""||$p5==""||$p6==""||$p7==""||$p8==""||$p9==""||$p10==""||$p11==""||$p12==""||$p13==""||$p14==""){
      echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인하여 주세요";
      return;
    }
    $query = "select * from house_main where house_id='".$target."';";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===1){
      $query = "update house_main set `user_id`='".$_SESSION['id']."', `house_id`='".$target."', `house_title`='".$p14."', `resident_gender`=".$p1.", `house_type`=".$p2.", `number_of_rooms`=".$p3.", `number_of_toilet`=".$p4.", `live_master`=".$p5.", `parking`=".$p6.", `pet`=".$p7.", `address`='".$p8."', `address_detail`='".$p9."', `address_detail_show`
      ='".$p10."', `traffic`='".$p11."', `facilities`='".$p12."', `condition`='".$p13."', `register_time`=now() where house_id='".$target."';";
      $result = mysqli_query($conn, $query);
    }
    else{
      $query = "insert into house_main (`user_id`, `house_id`, `house_title`, `resident_gender`, `house_type`, `number_of_rooms`, `number_of_toilet`, `live_master`, `parking`, `pet`, `address`, `address_detail`, `address_detail_show`, `traffic`, `facilities`, `condition`, `register_time`) VALUES ('".$_SESSION['id']."', '".$target."', '".$p14."', ".$p1.", ".$p2.", ".$p3.", ".$p4.", ".$p5.", ".$p6.", ".$p7.", '".$p8."', '".$p9."',
      ".$p10.", '".$p11."', '".$p12."', '".$p13."', now());";
      $result = mysqli_query($conn, $query);

    }
    if($result) echo "저장 성공!";
    else echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인하여 주세요";
  }
  elseif($condition=="register_2"){
    $query = "select number_of_rooms from house_main where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===1){
      if($r1=="" ||$r2=="" ||$r3==""||$r4==""||$r5==""||$r6==""||$r7==""||$r8==""){
        echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인하여 주세요";
        return;
      }
      $row = mysqli_fetch_row($result);
      if($current>=$row[0]){
        echo "추가할 수 있는 방의 갯수는 1단계-일반사항에서 입력한 방의 갯수를 초과할 수 없습니다.";
      }
      else{
        $goods = join(',', $r8);
        $room_id = $target."_".$current;
        $query = "select * from house_rooms where room_id='".$room_id."'";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)===1){
          $query = "update `house_rooms` set `house_id`='".$target."', `room_id`='".$room_id."', `person`=".$r1.", `gender`=".$r2.", `master`=".$r3.", `rule`=".$r4.", `rent`=".$r5.", `guarantee`=".$r6.", `manage`=".$r7.", `goods`='".$goods."' where room_id='".$room_id."';";
          $result = mysqli_query($conn, $query);
          $query = "delete from `house_beds` where room_id='".$room_id."';";
          $result = mysqli_query($conn, $query);
          $i=0;
          while($i<$r1){
            $bed_id=$room_id."_".$i;
            $query = "insert into `house_beds` (`room_id`, `bed_id`, `condition`) value ('".$room_id."', '".$bed_id."', 1);";
            $result = mysqli_query($conn, $query);
            $i = $i + 1;
          }
        }
        else{
          $query = "insert into `house_rooms` (`house_id`, `room_id`, `person`, `gender`, `master`, `rule`, `rent`, `guarantee`, `manage`, `goods`) values ('".$target."', '".$room_id."', ".$r1.", ".$r2.", ".$r3.", ".$r4.", ".$r5.", ".$r6.", ".$r7.", '".$goods."' );";
          $result = mysqli_query($conn, $query);
          $i=0;
          while($i<$r1){
            $bed_id=$room_id."_".$i;
            $query = "insert into `house_beds` (`room_id`, `bed_id`, `condition`) value ('".$room_id."', '".$bed_id."', 1);";
            $result = mysqli_query($conn, $query);
            $i = $i + 1;
          }
        }

        if($result) echo "저장 성공!";
        else echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인하여 주세요";
      }
    }
    else{
      echo "아직 1단계에서 방 갯수를 입력하지 않으셨습니다. 1단계부터 완료하여 주세요.";
    }

  }
  elseif($condition=="register_3"){
    if($s1=="" ||$s2=="" ||$s3==""){
      echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인하여 주세요";
      return;
    }
    $query = "select * from house_public where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    $goods = join(',', $s3);
    if(mysqli_num_rows($result)===1){
      $query = "update house_public set `house_id`='".$target."', `description`='".$s1."', `services`='".$s2."', `goods`='".$goods."' where house_id='".$target."';";
      $result = mysqli_query($conn, $query);
    }
    else{
      $query = "insert into house_public (`house_id`, `description`, `services`, `goods`) VALUES ('".$target."', '".$s1."', '".$s2."', '".$goods."')";
      $result = mysqli_query($conn, $query);
    }
    if($result) echo "저장 성공!";
    else echo "저장 실패! 아직 입력하지 않은 값이 있는지 확인하여 주세요";
  }
  elseif($condition=="delete"){
    $query = "delete from house_main where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    $query = "select room_id from house_rooms where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    while($row = mysqli_fetch_row($result)){
      $tmpQuery = "delete from house_beds where room_id='".$row[0]."'";
      $tmpResult = mysqli_query($conn, $tmpQuery);
    }
    $query = "delete from house_rooms where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    $query = "delete from house_public where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
  }
  elseif($condition=="check_trash"){
    $query = "select number_of_rooms from house_main where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_row($result);
    for($i=$row[0];$i<20;++$i){
      $room_id = $target."_".$i;
      $query = "select * from house_rooms where room_id='".$room_id."'";
      $result = mysqli_query($conn, $query);
      if(mysqli_num_rows($result)===1){
        $tmpQuery = "delete from house_beds where room_id='".$room_id."'";
        $tmpResult = mysqli_query($conn, $tmpQuery);
        $query = "delete from house_rooms where room_id='".$room_id."'";
        $result = mysqli_query($conn, $query);
      }
    }
    echo $row[0];
  }
  elseif($condition=="check_add"){
    $query = "select number_of_rooms from house_main where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    $row=mysqli_fetch_row($result);
    if($current!=$row[0]-1) echo "canDo";
    else echo "cantDo";
  }
  elseif($condition=="check_done"){
    $return = "";
    $query = "select * from house_main where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===0) $return = $return."1단계 ";
    $query = "select * from house_rooms where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===0) $return = $return."2단계 ";
    $query = "select * from house_public where house_id='".$target."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===0) $return = $return."3단계 ";
    if($return==""){
      $current = $current + 1;
      $query = "update house_main set `number_of_rooms`=".$current." where house_id='".$target."';";
      $result = mysqli_query($conn, $query);
      echo "done";
    }
    else echo $return;
  }
?>
