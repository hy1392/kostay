<?

########## 클래스 파일 참조 ##########
include "class.sms.php";

########## 변수값 전달 받기 ##########
// php.ini 설정에서 register_globals = Off 일 경우
// POST 방식 : $HTTP_POST_VARS[]
// GET 방식 : $HTTP_GET_VARS[]
// 로 전달받아 사용하시기 바랍니다.

## register_globals = Off 이고 POST 방식일 경우 ##
//$arrCallNo = $HTTP_POST_VARS["arrCallNo"];//수진자 번호
//$strCallBack = $HTTP_POST_VARS["strCallBack"];//발신자 번호
//$strMsg = $HTTP_POST_VARS["strMsg"];//보낼 메세지 내용
//$strMsg	= iconv("UTF-8", "EUC-KR", $strMsg);
//
//$NOWLATER = $HTTP_POST_VARS["NOWLATER"];
//$rsvYear = $HTTP_POST_VARS["rsvYear"];
//$rsvMonth = $HTTP_POST_VARS["rsvMonth"];
//$rsvDay = $HTTP_POST_VARS["rsvDay"];
//$rsvHour = $HTTP_POST_VARS["rsvHour"];
//$rsvMinute = $HTTP_POST_VARS["rsvMinute"];
//
//########## 사용자 변수 등록 ##########
//$caller = "Kostay관리자";						// 송신자 명
//$success = $fail = 0;		// 성공, 실패 초기값
//
//########## 배열값 추출하기 ##########
//$strGroup = explode(",",$arrCallNo);
//$GroupCNT = sizeof($strGroup);

########## 예약전송일 경우 ##########
/*if ($NOWLATER == "LATER") {

	## 예약일자 형식에 맞추기 ##
	$rsvMonth = (int)$rsvMonth;
	if ($rsvMonth < 10) { $rsvMonth = "0".$rsvMonth; }

	$rsvDay = (int)$rsvDay;
	if ($rsvDay < 10) { $rsvDay = "0".$rsvDay; }

	$rsvHour = (int)$rsvHour;
	if ($rsvHour < 10) { $rsvHour = "0".$rsvHour; }

	$rsvMinute = (int)$rsvMinute;
	if ($rsvMinute < 10) { $rsvMinute = "0".$rsvMinute; }

	## 예약일자 체크 ##
	// 예약일이 현재일보다 전이면 에러
	$c_rsvYear = Date(Y);
	$c_rsvMonth = Date(m);
	$c_rsvDay = Date(d);
	$c_rsvHour = Date(H);
	$c_rsvMinute = Date(i);

	Check_Date($rsvYear, $c_rsvYear, $rsvMonth, $c_rsvMonth, $rsvDay, $c_rsvDay, $rsvHour, $c_rsvHour);

	## 일자 변수 형식에 맞게 치환 ##
	$rsvTime = $rsvYear.$rsvMonth.$rsvDay.$rsvHour.$rsvMinute;
} else {
	$rsvTime = "";
}
*/
########## SMS 서버에 발송하기 ##########
$SMS = new SMS;
$result = $SMS->Open();	// SMS 서버 연결

// for($i=0; $i < $GroupCNT; $i++) {
// 	$result = $SMS->Add($strGroup[$i],$strCallBack,$caller,$strMsg,$rsvTime); // 일반메시지 입력
// }

$strGroup="01050250874";//보내는사람
$strCallBack = "01050250874";//받는사람
$caller="Kostay관리자";//보내는사람 이름
$strMsg="코스테이 테스트 메시지 입니다.";//보낼 메세지 내용
$strMsg	= iconv("UTF-8", "EUC-KR", $strMsg);
$rsvTime = "";//예약시간
echo $strGroup;
$result = $SMS->Add($strGroup,$strCallBack,$caller,$strMsg,$rsvTime);
$result = $SMS->Send();	// 메세지 전송

if ($result) {
	foreach($SMS->Result as $result) {
		list($phone,$code)=explode(":",$result);
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
?>
