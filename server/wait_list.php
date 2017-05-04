<?php
  include 'dbconnect.php';
  require '../PHPMailer/PHPMailerAutoload.php';

//phpmailer
$mail = new PHPMailer;
$mail->isSMTP();                                      // Set mailer to use SMTP
//$mail->Host = 'hp207.hostpapa.com';  // Specify main and backup SMTP servers
$mail->Host = 'hp207.hostpapa.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'mail01@kostay.net';                 // SMTP username
$mail->Password = 'mail01';                           // SMTP password
                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
               // Name is optional
$mail->CharSet    = "EUC-KR";
$mail->Encoding   = "base64";
$mail->isHTML(true);                                  // Set email format to HTML


//!phpmailer

//  include "../kostayEmail/Sendmail.php";
//  include "../kostaySms/class.sms.php";
//  $SMS = new SMS;
//  $smsresult = $SMS->Open();	// SMS 서버 연결
//  $success = $fail = 0;

//  $sendmail = new Sendmail();
  extract($_POST);
  $from="Kostay.net";
  $titleQuery = "select * from house_main where house_id='".$house_id."'";
  $titleResult = mysqli_query($conn, $titleQuery);
  $titleRow = mysqli_fetch_array($titleResult);
  $to=$titleRow['user_id'];
  $mail->addAddress($to);
  //$mail->addAddress("khgusaac@gmail.com");

  //수신자 번호
  $useridQuery = "select * from house_main where house_id='".$house_id."'";
  $useridResult = mysqli_query($conn, $useridQuery);
  $useridRow = mysqli_fetch_array($useridResult);
  $smsQuery = "select * from users where email='".$useridRow['user_id']."'";
  $smsResult = mysqli_query($conn, $smsQuery);
  $smsRow = mysqli_fetch_array($smsResult);

  if($condition=="신청"){
    $initQuery = "select * from user_movein_list where email='".$_SESSION['id']."' and `bed_id`='".$bed_id."'";
    $initResult = mysqli_query($conn, $initQuery);
    if(mysqli_num_rows($initResult)!=0){
        echo "이미 입주신청을 완료한 하우스 입니다.";
        return false;
    }
    if($visit_date!="" && $visit_time!="") {
        $visit_date_modified = $visit_date." ".$visit_time;
        $query = "insert into user_movein_list (`email`,`gender`,`nationality`,`age`,`hp`,`contact_email`,`notify`,`visit_date`,`movein_date`,`skip_visit`,`description`,`house_id`,`bed_id`, `time`)
    values ('".$_SESSION['id']."', '".$gender."', '".$nationality."', '".$age."','".$hp."','".$contact_email."','".$notify."','".$visit_date_modified."','".$movein_date."','".$skip_visit."','".$description."','".$house_id."','".$bed_id."', now());";
    }
    else{
      $query = "insert into user_movein_list (`email`,`gender`,`nationality`,`age`,`hp`,`contact_email`,`notify`,`visit_date`,`movein_date`,`skip_visit`,`description`,`house_id`,`bed_id`, `time`)
    values ('".$_SESSION['id']."', '".$gender."', '".$nationality."', '".$age."','".$hp."','".$contact_email."','".$notify."',null,'".$movein_date."','".$skip_visit."','".$description."','".$house_id."','".$bed_id."', now());";
    }

    $result = mysqli_query($conn, $query);
    $countQuery = "select * from user_movein_list where `bed_id`='".$bed_id."'";
    $countResult=mysqli_query($conn, $countQuery);
    $row=mysqli_num_rows($countResult);


$mail->Subject=iconv("UTF-8", "EUC-KR", "[KOSTAY] 등록한 하우스에 새로운 입주신청자가 등록되었습니다!!");
$mail->Body="[KOSTAY] 지금 등록하신 하우스 '".$titleRow['house_title']."' 에 새로운 입주신청자가 등록되었습니다. 지금 바로 확인해보세요! http://kostay.net";
$mail->send();

    //신청결과 반환
    echo $row;

    //SMS전송
//    $target = $smsRow['hp'];
//    $strCallBack = "01050250874";//발신자
//    $caller="Kostay관리자";//보내는사람 이름
//    $strMsg="[KOSTAY] 지금 등록하신 하우스 '".$titleRow['house_title']."' 에 새로운 입주신청자가 등록되었습니다. 지금 바로 확인해보세요! http://kostay.net";//보낼 메세지 내용
//    $strMsg	= iconv("UTF-8", "EUC-KR", $strMsg);
//    $rsvTime = "";//예약시간
//    $smsresult = $SMS->Add($target,$strCallBack,$caller,$strMsg,$rsvTime);
//    $smsresult = $SMS->Send();	// 메세지 전송

//    if ($smsresult) {
//        foreach($SMS->Result as $smsresult) {
//            list($phone,$code)=explode(":",$smsresult);
//            if ($code=="Error") {
//                echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
//                $fail++;
//            } else {
//                echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>". "전송 내용 : ".$strMsg.'<br>';
//                $success++;
//            }
//        }
//    }

  }
  elseif($condition=="대기"){
    $initQuery = "select * from user_wait_list where email='".$_SESSION['id']."' and `bed_id`='".$bed_id."'";
    $initResult = mysqli_query($conn, $initQuery);
    if(mysqli_num_rows($initResult)!=0){
        echo "이미 대기신청을 완료한 하우스 입니다.";
        return false;
    }
    $query = "insert into user_wait_list (`email`,`gender`,`nationality`,`age`,`hp`,`contact_email`,`notify`,`movein_date`,`description`,`house_id`,`bed_id`, `time`)
    values ('".$_SESSION['id']."', '".$gender."', '".$nationality."', '".$age."','".$hp."','".$contact_email."','".$notify."','".$movein_date."','".$description."','".$house_id."','".$bed_id."', now());";
    $result = mysqli_query($conn, $query);
    $countQuery = "select * from user_wait_list where `bed_id`='".$bed_id."'";
    $countResult=mysqli_query($conn, $countQuery);
    $row=mysqli_num_rows($countResult);

$mail->Subject=iconv("UTF-8", "EUC-KR", "[KOSTAY] 등록한 하우스에 새로운 대기ㅋ신청자가 등록되었습니다!!");
$mail->Body="[KOSTAY] 지금 등록하신 하우스 '".$titleRow['house_title']."' 에 새로운 대기신청자가 등록되었습니다. 지금 바로 확인해보세요! http://kostay.net";
$mail->send();
    echo $row;
//    $strCallBack = "01050250874";//발신자
//    $caller="Kostay관리자";//보내는사람 이름
//    $strMsg="[KOSTAY] 지금 등록하신 하우스 '".$titleRow['house_title']."' 에 새로운 대기신청자가 등록되었습니다. 지금 바로 확인해보세요! http://kostay.net";//보낼 메세지 내용
//    $strMsg	= iconv("UTF-8", "EUC-KR", $strMsg);
//    $rsvTime = "";//예약시간
//    $smsresult = $SMS->Add($smsRow['hp'],$strCallBack,$caller,$strMsg,$rsvTime);
//    $smsresult = $SMS->Send();	// 메세지 전송
//
//    if ($smsresult) {
//        foreach($SMS->Result as $smsresult) {
//            list($phone,$code)=explode(":",$smsresult);
//            if ($code=="Error") {
//                echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
//                $fail++;
//            } else {
//                echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>". "전송 내용 : ".$strMsg.'<br>';
//                $success++;
//            }
//        }
//    }

  }
  elseif($condition=="get"){

  }
  else{
    echo "처리도중 에러가 발생하였습니다. 잠시후 다시 시도해주세요.";
  }
//$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.
//
//    $SMS->Close();	// SMS 서버 연결 종료
  mysqli_close($conn);
?>
