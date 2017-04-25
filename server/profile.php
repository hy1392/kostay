<?php
  include 'dbconnect.php';

  extract($_POST);
$loc="";
if(isset($_FILES["file"])){
    $file=$_FILES["file"];
  $description = $_POST['description'];
  if(0<$file['error']){
    echo "업로드할 파일이 잘못되었습니다. 파일을 확인하시고 다시 첨부해 주세요";
  }
  else{
    $filename=$file['name'];
    $tmp_name=explode(".",$filename);
    $filename=$_SESSION['id'].".".$tmp_name[1];
    move_uploaded_file($file['tmp_name'], 'user_profile/'.$filename);
      $loc='server/user_profile/'.$filename;
  }
    $query = "select * from user_profile where email='".$_SESSION['id']."'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)===1){
    $query = "update user_profile set `img`='".$loc."', `description`='".$description."', `hp`='".$hp."', `contactemail`='".$contactemail."', `kakao`='".$kakao."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
    $query = "update users set `hp`='".$hp."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
  }
  else{
    $query = "insert into user_profile (`email`, `img`, `description`, `hp`, `contactemail`, `kakao`) values('".$_SESSION['id']."','".$loc."','".$description."','".$hp."', '".$contactemail."', '".$kakao."')";
    $result = mysqli_query($conn, $query);
    $query = "update users set `hp`='".$hp."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
  }
    return;
}
  $query = "select * from user_profile where email='".$_SESSION['id']."'";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)===1){
    $query = "update user_profile set `description`='".$description."', `hp`='".$hp."', `contactemail`='".$contactemail."', `kakao`='".$kakao."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
    $query = "update users set `hp`='".$hp."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
  }
  else{
    $query = "insert into user_profile (`email`, `description`, `hp`, `contactemail`, `kakao`) values('".$_SESSION['id']."','".$description."','".$hp."', '".$contactemail."', '".$kakao."')";
    $result = mysqli_query($conn, $query);
    $query = "update users set `hp`='".$hp."' where email = '".$_SESSION['id']."'";
    $result = mysqli_query($conn, $query);
  }
  

  

  mysqli_close($conn);
?>
