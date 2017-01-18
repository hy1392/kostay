<?
  include 'dbconnect.php';
  extract($_POST);
  if($type=="r"){
    $query = "update message set rdeleted=rdeleted-1 where idx=".$target.";";
    $result = mysqli_query($conn, $query);
  }
  elseif($type=="s"){
    $query = "update message set sdeleted=sdeleted-1 where idx=".$target.";";
    $result = mysqli_query($conn, $query);
  }
  elseif($type=="p"){
    $query = "select rdeleted, sdeleted from message where idx = '".$target."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_row($result);
    if($row[0]==0){
      $query = "update message set rdeleted=rdeleted-1 where idx=".$target.";";
      $result = mysqli_query($conn, $query);
    }
    elseif($row[1]==0){
      $query = "update message set sdeleted=sdeleted-1 where idx=".$target.";";
      $result = mysqli_query($conn, $query);
    }
  }
  $query = "select rdeleted, sdeleted from message where idx = '".$target."'";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_row($result);
  if($row[0]==-1 and $row[1]==-1){
    $query = "delete from message where idx=".$target.";";
    $result = mysqli_query($conn, $query);
  }

  mysqli_close($conn);
?>
