<?php
include 'dbconnect.php';
echo '<html><head><script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAxwBuJWDjuX_iABj5vaPO5ljMD_nGflB4&amp;libraries=places"></script>';
echo '<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script></head><body>';
echo '<script>var destination;var service;var geocoder; var origin; var latlng; var search_id; var origin_condition;</script>';

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
$typeQuery ="select person from house_rooms where house_id='".$row['house_id']."'";
$typeResult = mysqli_query($conn, $typeQuery);
while($typeRow = mysqli_fetch_row($typeResult)){
  $tmp_type.=",".$typeRow[0];
}
echo $tmp_type;
$tmp_type=explode(",",$tmp_type);
for($i=0; $i<sizeof($tmp_type); $i++){
  if((int)$tmp_type[$i]==1) $type.=",1";
  else if((int)$tmp_type[$i]==2) $type.=",2";
  else if((int)$tmp_type[$i]==3) $type.=",3";
  else if((int)$tmp_type[$i]==4) $type.=",4";
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



//---------------------------------------------------------------------------------------------
//알림 전용

$alarmQuery = "select * from alarm where cont='1'";
$alarmResult = mysqli_query($conn, $alarmQuery);
while($alarmRow = mysqli_fetch_array($alarmResult)){ 
    
    $query_house = array();
$query_room = array();

  if($alarmRow['gender']!=null) array_push($query_house, " `gender` = '".$alarmRow['gender']."' ");

  if($alarmRow['house_type']!=null){
    if($alarmRow['house_type']==0){
      array_push($query_house, " (`house_type`  = '1' or `house_type` = '2')");
    }
    else if($alarmRow['house_type']) array_push($query_house, " `house_type` = '1'");
    else if($alarmRow['house_type']) array_push($query_house, " `house_type` = '2'");
  }

  if($alarmRow['type']!=null){
    if($alarmRow['type']==4){
        array_push($query_house, " `type` like '%4%'");
    }
    else if($alarmRow['type']==1) array_push($query_house, " `type` like '%1%'");
    else if($alarmRow['type']==2) array_push($query_house, " `type` like '%2%'");
    else if($alarmRow['type']==3) array_push($query_house, " `type` like '%3%'");
  }

if($alarmRow['min_rent']!=null){
    $low=$alarmRow['min_rent'];
    $high=$alarmRow['max_rent'];
    array_push($query_house, " (`min_rent` >= ".$low." and `max_rent` <= ".$high.")");
}


  if($alarmRow['park']!=null){
    if($alarmRow['park']=="0"){}
    else if($alarmRow['park']=="1") array_push($query_house, " `park` = 1");
  }


  if($alarmRow['date']!=null){
      if($alarmRow['date_condition']==0){}
      else if($alarmRow['date_condition']==1) array_push($query_house, " `date` <= '".$alarmRow['date']."'");
      else if($alarmRow['date_condition']==2) array_push($query_house, " `date` >= '".$alarmRow['date']."'");  
  }


  if($alarmRow['person']!=null) {
    if($alarmRow['person']==0){
    }
    elseif($alarmRow['person']==4){
      array_push($query_room, " `person` >= ".$alarmRow['person']." ");
    }
    else{
      array_push($query_room, " `person` = ".$alarmRow['person']." ");
    }
  }


array_push($query_house, " ad='1'");

array_push($query_house, " house_id='".$house_id."'");

$origin=$alarmRow['address'];;
$origin_condition=0;

if(($alarmRow['alarm_param']!=null || $alarmRow['alarm_loc']!=null)){
  if($alarmRow['alarm_loc']==1){
    $origin_condition = $alarmRow['alarm_param'];
  }
  else if($alarmRow['alarm_loc']==2){
    $origin_condition = 8;
  }
  else if($alarmRow['alarm_loc']==3){
    $origin_condition = $alarmRow['alarm_param'] * 5;
  }
}
    

$query = "select house_id from search ";
$query_count = "select count(*) from search";
for($i=0; $i<count($query_house);++$i){
  if($i==0) {
    $query .= " where ";
    $query_count .= " where ";
  }
  else{
    $query .= " and ";
    $query_count .= " and ";
  }
  $query .= $query_house[$i];
  $query_count .= $query_house[$i];
}

$query .=  " order by register_time DESC";
$query_count .=  " order by register_time DESC";

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result)==1){
?>
    <script type="text/javascript">
  

  geocoder =  new google.maps.Geocoder();
  geocoder.geocode({'address':'<?=$origin?>'}, function(results, status) {

          if (status == google.maps.GeocoderStatus.OK)
          {
            for(var i=0;i<results.length;i++)
            {
              origin = new google.maps.LatLng(results[i].geometry.location.lat(), results[i].geometry.location.lng());
              destination = "<?= $address ?>";
              service = new google.maps.DistanceMatrixService();
              service.getDistanceMatrix(
              {
                  origins: [origin],
                  destinations: [destination],
                  travelMode: google.maps.TravelMode.DRIVING,
                  unitSystem: google.maps.UnitSystem.METRIC,
                  avoidHighways: false,
                  avoidTolls: false
              },
                  callback
              );
            }
          }
          else{
            //alert("Geocode was not successful for the following reason: " + status);
          }
      });

      //var origin = new google.maps.LatLng(55.930385, -3.118425),
      //var origin = new google.maps.LatLng(37.335887, 126.584063),
      function callback(response, status) {
        /*
        var orig = document.getElementById("orig"),
            dest = document.getElementById("dest"),
            dist = document.getElementById("dist");
        */

        if(status=="OK"){
          /*
          dest.value = response.destinationAddresses[0];
          orig.value = response.originAddresses[0];
          */
          //dist.value = response.rows[0].elements[0].distance.text;
            var distance = new Array();
            try{
                distance = response.rows[0].elements[0].distance.text.split('');      
            }catch(exception){
                distance.push(0);
            }

          origin_condition = "<?=$origin_condition?>";
            console.log(origin);
            console.log(destination);
            console.log(origin_condition);
            console.log(distance[0]);
          if(<?=$origin_condition?> >= distance[0]){
            $.ajax({
              url:"alarm_result.php",
              type:"POST",
              data:{
                alarm_id:"<?=$alarmRow['alarm_id']?>"
              },
              success: function(data){
                  console.log((origin_condition <= distance[0]));
              },
              error: function(){
              }
            });
          }
        } else {
          //alert("ERROR");
          //alert("Error: " + status);
        }
      }
      </script>
<?        
    }
?>
<?

}
echo "</body></html>"
?>
