<?php
  include 'dbconnect.php';
  extract($_POST);
  $tmp = "";
  $i=0;
  while(1){
    $tmp = $_SESSION['id']."_".$i;
    $query = "select * from house_main where house_id='".$tmp."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)===0) break;
    $i=$i+1;
  }
  $query = "insert into house_main (`user_id`, `house_id`, `house_title`, `resident_gender`, `house_type`, `number_of_rooms`, `number_of_toilet`, `live_master`, `parking`, `pet`, `address`, `address_detail`, `address_detail_show`, `traffic`, `facilities`, `condition`, `register_time`) VALUES ('".$_SESSION['id']."', '".$tmp."', '".$p14."', ".$p1.", ".$p2.", ".$p3.", ".$p4.", ".$p5.", ".$p6.", ".$p7.", '".$p8."', '".$p9."',
  ".$p10.", '".$p11."', '".$p12."', '".$p13."', now());";
  $result = mysqli_query($conn, $query);

$stmp = join(',', $s3);

  $query = "insert into house_public (`house_id`, `description`, `services`, `goods`) VALUES ('".$tmp."', '".$s1."', '".$s2."', '".$stmp."')";
  $result = mysqli_query($conn, $query);
  echo $query;
?>
