<?
include 'dbconnect.php';
extract($_POST);
if(isset($condition)){
    $checkQuery = "select count(*) from search_result where username='".$search_id."'";
    $checkResult = mysqli_query($conn, $checkQuery);
    $checkRow = mysqli_fetch_row($checkResult);
    if($checkRow[0]>0) echo "true";
    else echo "false";
    return;
}
if(isset($delete)){
    $checkQuery = "delete from search_result where username='".$search_id."'";
    $checkResult = mysqli_query($conn, $checkQuery);
    return;
}
if(isset($search_id)){
    if($search_id!=""){
        $query = "insert into search_result (username, house_id) values ('".$search_id."','".$house_id."')";
    $result = mysqli_query($conn, $query);
    }
}
?>
