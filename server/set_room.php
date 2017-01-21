<?php
  include 'dbconnect.php';
  extract($_POST);
  if($condition=="get"){
    $roomType  = array();
    $bedNum  = array();
    $gender  = array();
    $bedCon  = array();
    $day  = array();
    $bedId = array();
    $query = "select * from house_rooms where house_id='".$house_id."' order by room_id ASC;";
    $result = mysqli_query($conn, $query);

    while($row=mysqli_fetch_array($result)){
      $query2 = "select * from house_beds where room_id='".$row['room_id']."' order by bed_id ASC;";
      $result2 = mysqli_query($conn, $query2);
      $i=1;
      while($row2=mysqli_fetch_array($result2)){
        array_push($bedId, $row2['bed_id']);
        array_push($roomType, $row['person']);
        if($row['gender']==1) array_push($gender, "남자");
        elseif($row['gender']==2) array_push($gender, "여자");
        elseif($row['gender']==3) array_push($gender, "혼성");
        elseif($row['gender']==4) array_push($gender, "커플");
        array_push($bedNum, $i);
        if($row2['condition']==1) array_push($bedCon, "만실");
        elseif($row2['condition']==2) array_push($bedCon, "공실 예정");
        elseif($row2['condition']==3) array_push($bedCon, "공실");
        array_push($day, $row2['vacant']);
        $i= $i+1;
      }

    }
    $o = array($bedId, $roomType, $bedNum, $gender, $bedCon, $day);
    echo json_encode($o);
  }
  elseif($condition=="con"){
    $query = "update house_beds set `condition`=".$value." where bed_id='".$target."';";
    $result = mysqli_query($conn, $query);
  }
  elseif($condition=="day"){
    $query = "update house_beds set vacant='".$value."' where bed_id='".$target."';";
    $result = mysqli_query($conn, $query);
  }
?>
