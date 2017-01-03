<?php
  include 'dbconnect.php';

  $request_body = file_get_contents('php://input');
  //$param = json_decode($_GET['index']);
  $param = json_decode(stripcslashes($request_body), true);
  //echo "Hello".$param;
  //print_r($param);
  echo "<br/><br/>";

  $size_pm = count($param);
  $i = 0;

  $array_index = array();
  $array_flag  = array();

  for($i=0; $i<$size_pm; $i++){
    $array_index[$i] = $param[$i]['index'];
    $array_flag[$i]  = $param[$i]['flag'];
  }

  //print_r($array_index);
  echo "<br/><br/>";
  //print_r($array_flag);

  //echo $array_index[0];
  for($i=0; $i<$size_pm; $i++){
    $idx = $array_index[$i] + 1;
    //echo $idx."<br/>";
    $query = "update users set flag=".$array_flag[$i]." where idx=".$idx;
    mysqli_query($conn, $query);
  }
?>
