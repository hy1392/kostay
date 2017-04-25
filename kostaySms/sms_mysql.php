<?

########## 클래스 파일 참조 ##########
include "class.sms.php";

########## 변수값 전달 받기 ##########
// php.ini 설정에서 register_globals = Off 일 경우
// POST 방식 : $HTTP_POST_VARS[]
// GET 방식 : $HTTP_GET_VARS[]
// 로 전달받아 사용하시기 바랍니다.

## register_globals = Off 이고 POST 방식일 경우 ##
$arrCallNo = $HTTP_POST_VARS["arrCallNo"];
$strCallBack = $HTTP_POST_VARS["strCallBack"];
$strMsg = $HTTP_POST_VARS["strMsg"];
$NOWLATER = $HTTP_POST_VARS["NOWLATER"];
$rsvYear = $HTTP_POST_VARS["rsvYear"];
$rsvMonth = $HTTP_POST_VARS["rsvMonth"];
$rsvDay = $HTTP_POST_VARS["rsvDay"];
$rsvHour = $HTTP_POST_VARS["rsvHour"];
$rsvMinute = $HTTP_POST_VARS["rsvMinute"];

########## 배열값 추출하기 ##########
$strGroup = explode(",",$arrCallNo);
$GroupCNT = sizeof($strGroup);

########## 예약전송일 경우 ##########
if ($NOWLATER == "LATER") {

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
	$rsvDate = $rsvYear.$rsvMonth.$rsvDay;
	$rsvTime = $rsvHour.$rsvMinute;
} else {
	$rsvDate = "";
	$rsvTime = "";
}

########## SMS 데이터베이스에 입력하기 ##########
$MySQL = new MySQL;
$result = $MySQL->Open();	// SMS 데이터베이스 서버 연결

$success = $fail = 0;
for($i=0; $i < $GroupCNT; $i++) {
	$result = $MySQL->Insert($strGroup[$i],$strCallBack,$strMsg,$rsvDate,$rsvTime); // SMS 데이터베이스 서버 메시지 입력
	if (!$result) {
		$fail ++;
	} else {
		$success ++;
	}
}

echo "총 ".$GroupCNT."건 중<br>성공 : ".$success."건 입력 성공 <br>실패 : ".$fail."건 입력 실패";

$result = $MySQL->Close();	// SMS 데이터베이스 서버 종료
?>