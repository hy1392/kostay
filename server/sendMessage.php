<?
  include 'dbconnect.php';
  extract($_POST);
  if(isset($condition)){
      if($condition=="mdelete"){
          $query = "delete from user_movein_list where idx='".$target."'";
          $result = mysqli_query($conn, $query);
          return;
      }
      else if($condition=="requset"){
          $query = "select * from user_movein_list where idx='".$target."'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_array($result);
          $roomidQuery = "select * from house_beds where bed_id='".$row['bed_id']."'";
          $roomidResult = mysqli_query($conn, $roomidQuery);
          $roomidRow = mysqli_fetch_array($roomidResult);
          $bedidQuery = "select * from house_beds where room_id='".$roomidRow['room_id']."'";
          $bedidResult = mysqli_query($conn, $bedidQuery);
          $initQuery = "select * from request_movein_list where email='".$row['email']."' and (";
          $isFirst = true;
          while($bedidRow = mysqli_fetch_array($bedidResult)){
              if($isFirst) $isFirst=false;
              else{
                  $initQuery.=" or ";
              }
              $initQuery.="bed_id='".$bedidRow['bed_id']."'";
          }
          $initQuery.=")";
          $initResult = mysqli_query($conn, $initQuery);
          if(mysqli_num_rows($initResult)===0){
              $msgQuery = "insert into request_movein_list (`email`,`date`,`house_id`,`bed_id`) values('".$row['email']."', '".$date."', '".$row['house_id']."', '".$row['bed_id']."')";
              $msgResult = mysqli_query($conn,$msgQuery);
              echo "done";
          }
          else echo "dup";
          return;
      }
      else if($condition=="accept"){
          $query = "select * from request_movein_list where idx='".$target."'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_array($result);
          $receiver = explode("_", $row['house_id']);
          $receiver = $receiver[0];
          $query = "insert into `message` (`sent_id`, `title`, `receiver`, `content`, `rdeleted`, `sdeleted`, `sent_time`) values ('".$_SESSION['id']."',' ', '".$receiver."', '".$_SESSION['id']."님이 입주 제안을 수락하셨습니다."."', 1, -1, now());";
          $result = mysqli_query($conn, $query);
      }
      else if($condition=="decline"){
          $query = "select * from request_movein_list where idx='".$target."'";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_array($result);
          $receiver = explode("_", $row['house_id']);
          $receiver = $receiver[0];
          $query = "insert into `message` (`sent_id`, `title`, `receiver`, `content`, `rdeleted`, `sdeleted`, `sent_time`) values ('".$_SESSION['id']."',' ', '".$receiver."', '".$_SESSION['id']."님이 입주 제안을 거절하셨습니다."."', 1, -1, now());";
          $result = mysqli_query($conn, $query);
      }
      $deleteQuery = "delete from request_movein_list where idx='".$target."'";
      $deleteResult = mysqli_query($conn, $deleteQuery);
      return;
  }
  $query = "insert into `message` (`sent_id`, `title`, `receiver`, `content`, `rdeleted`, `sdeleted`, `sent_time`) values ('".$_SESSION['id']."','".$title."', '".$target."', '".$content."', 1, 1, now());";
  $result = mysqli_query($conn, $query);
  mysqli_close($conn);
?>