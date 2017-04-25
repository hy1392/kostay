<?
include 'dbconnect.php';
include "../kostayEmail/Sendmail.php";
include "../kostaySms/class.sms.php";
$SMS = new SMS;
$smsresult = $SMS->Open();	// SMS 서버 연결
$success = $fail = 0;

$sendmail = new Sendmail();
extract($_POST);

//수신자 번호
$useridQuery = "select * from alarm where alarm_id='".$alarm_id."'";
$useridResult = mysqli_query($conn, $useridQuery);
$useridRow = mysqli_fetch_array($useridResult);
$smsQuery = "select * from users where email='".$useridRow['user_id']."'";
$smsResult = mysqli_query($conn, $smsQuery);
$smsRow = mysqli_fetch_array($smsResult);


$query = "select * from alarm where alarm_id='".$alarm_id."'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);

//email
$from="Kostay.net";
$to=$row['user_id'];
$subject="[KOSTAY] 등록한 알림조건에 부합하는 새로운 하우스가 등록되었습니다!!";
$body="[KOSTAY] 지금 등록하신 알림 '".$row['alarm_title']."'의 조건에 부합하는 새로운 하우스가 등록되었습니다. 지금 바로 확인해보세요! http://kostay.net";
$sendmail->send_mail($to, $from, $subject, $body);

//SMS
$target = $smsRow['hp'];
$strCallBack = "01050250874";//발신자
$caller="Kostay관리자";//보내는사람 이름
$strMsg="[KOSTAY] 지금 등록하신 하우스 '".$row['alarm_title']."' 에 새로운 입주신청자가 등록되었습니다. 지금 바로 확인해보세요! http://kostay.net";//보낼 메세지 내용
$strMsg	= iconv("UTF-8", "EUC-KR", $strMsg);
$rsvTime = "";//예약시간
$smsresult = $SMS->Add($target,$strCallBack,$caller,$strMsg,$rsvTime);
$smsresult = $SMS->Send();	// 메세지 전송

if ($smsresult) {
    foreach($SMS->Result as $smsresult) {
        list($phone,$code)=explode(":",$smsresult);
        if ($code=="Error") {
            echo $phone.'로 발송하는데 에러가 발생했습니다.<br>';
            $fail++;
        } else {
            echo $phone."로 전송했습니다. (메시지번호:".$code.")<br>". "전송 내용 : ".$strMsg.'<br>';
            $success++;
        }
    }
}

$SMS->Init(); // 보관하고 있던 결과값을 지웁니다.

$SMS->Close();	// SMS 서버 연결 종료
mysqli_close($conn);
?>
