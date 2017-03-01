<?php
include 'dbconnect.php';
extract($_POST);

$query = "select * from house_main where house_id='".$house_id."'";
$result = mysqli_query($conn, $query);
$row=mysqli_fetch_array($result);
$address =  $row['address']." ".$row['address_detail'];
$park=$row['parking'];
$register_time=$row['register_time'];
$gender=$row['resident_gender'];
$house_type=$row['house_type'];

$query = "select sum(person), max(rent), min(rent) from house_rooms where house_id='".$row['house_id']."'";
$result2 = mysqli_query($conn, $query);
$row2 = mysqli_fetch_row($result2);
$person=$row2[0];
$max_rent=$row2[1];
$min_rent=$row2[2];

$roomIdQuery = "select room_id from house_rooms where house_id='".$row['house_id']."';";
$roomIdResult = mysqli_query($conn, $roomIdQuery);
$roomCondition="";
$isFirst=true;
while($roomIdRow = mysqli_fetch_array($roomIdResult)){
  if($isFirst){
    $isFirst=false;
    $toAdd="room_id = '".$roomIdRow[0]."'";
    $roomCondition.=$toAdd;
  }
  else{
    $toAdd="or room_id = '".$roomIdRow[0]."'";
    $roomCondition.=$toAdd;
  }
}

$vacantQuery = "select min(vacant) from house_beds where (".$roomCondition.") and `condition`=2;";
$vacantResult = mysqli_query($conn, $vacantQuery);
$vacantRow = mysqli_fetch_array($vacantResult);
$date=$vacantRow[0];
if($date==null) $date="null";

$tmp_type="";
$type="";
$typeQuery ="select master from house_rooms where house_id='".$row['house_id']."'";
$typeResult = mysqli_query($conn, $typeQuery);
while($typeRow = mysqli_fetch_row($typeResult)){
  $tmp_type.=",".$typeRow[0];
}
$tmp_type=explode(",",$tmp_type);
for($i=0; $i<sizeof($tmp_type); $i++){
  if((int)$tmp_type[$i]==1) $type.=",1";
  else if((int)$tmp_type[$i]==2) $type.=",2";
  else $type.=",3";
}

$saveQeury = "select * from search where house_id='".$row['house_id']."'";
$saveResult = mysqli_query($conn, $saveQeury);
if($date=="null"){
  if(mysqli_num_rows($saveResult) === 0){
    $finalQuery = "insert into search (`house_id`,`address`,`gender`,`house_type`,`type`,`min_rent`,`max_rent`,`person`,`park`,`date`,`register_time`)
    values ('".$house_id."','".$address."','".$gender."','".$house_type."','".$type."',".$min_rent.",".$max_rent.",".$person.",'".$park."',".$date.",'".$register_time."')";
  }
  else{
    $finalQuery = "update search set `address`='".$address."',`gender`='".$gender."',`house_type`='".$house_type."',`type`='".$type."',`min_rent`=".$min_rent.",`max_rent`=".$max_rent.",`person`=".$person.",`park`='".$park."',`date`=".$date.",`register_time`='".$register_time."'
    where house_id='".$house_id."';";
  }
}
else{
  if(mysqli_num_rows($saveResult) === 0){
    $finalQuery = "insert into search (`house_id`,`address`,`gender`,`house_type`,`type`,`min_rent`,`max_rent`,`person`,`park`,`date`,`register_time`)
    values ('".$house_id."','".$address."','".$gender."','".$house_type."','".$type."',".$min_rent.",".$max_rent.",".$person.",'".$park."','".$date."','".$register_time."')";
  }
  else{
    $finalQuery = "update search set `address`='".$address."',`gender`='".$gender."',`house_type`='".$house_type."',`type`='".$type."',`min_rent`=".$min_rent.",`max_rent`=".$max_rent.",`person`=".$person.",`park`='".$park."',`date`='".$date."',`register_time`='".$register_time."'
    where house_id='".$house_id."';";
  }
}

mysqli_query($conn,$finalQuery);
echo $finalQuery;
?>
