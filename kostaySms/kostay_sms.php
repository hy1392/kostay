<html>
<head>
<title>(주)쏜다넷 :: SMS 샘플</title>
<link href="inc/jj.css" rel="stylesheet" type="text/css">
<script language="javascript" src="inc/sms.js"></script>
</head>

<body topmargin="0" leftmargin="0" bgcolor="#f9f9f9">
<!-- action에 해당하는 내용은 2가지가 제공이 됩니다. -->
<!-- 웹소켓전송(sms_socket.php)/데이터베이스전송(sms_mysql.php)적절히 이용하십시오. -->
<form name="MsgForm" method="post" action="sms_socket.php">
<input type="hidden" name="arrCallNo">
<table align="center" border="0" width="170" cellspacing="0" cellpadding="0">
	<tr>
		<td width="170" height="80"></td>
	</tr>
	<tr>
		<td width="170" bgcolor="#ffffff">
			<table align="center" border="0" width="170" cellspacing="0" cellpadding="0">
				<tr>
					<td width="170" height="5"></td>
				</tr>
				<tr>
					<td width="170">
						<table width="170" cellspacing="0" cellpadding="0" background="img/phone_01.gif" valign="top" id="backimg">
							<tr height="72">
								<td></td>
							</tr>
							<!-- sms 문자 입력 시작-->
							<tr>
								<td align="center">
									<textarea style="BORDER-RIGHT:1px;BORDER-TOP:1px;FONT-SIZE:9pt;BACKGROUND:none transparent scroll repeat 0% 0%;OVERFLOW:hidden;BORDER-LEFT:1px;WIDTH:110px;COLOR:#ffffff;BORDER-BOTTOM:1px;FONT-FAMILY:돋움,verdana;HEIGHT:100px" name="strMsg" onChange="ChkLen()" onKeyUp="ChkLen()"></textarea>
								</td>
							</tr>
							<tr height="21">
								<td align="center" valign="bottom"><font color="#ffffff"><input type="text" readonly name="msg_txt_cnt" size="2" maxlength="2" class="input4" value="0" style="COLOR:#ffffff"><input type="text" readonly name="fix_cnt" size="7" class="input4" value="/ 80문자" style="COLOR:#ffffff"></font></td>
							</tr>
							<!-- sms 문자 입력 끝-->
							<tr height="220" valign="top">
								<td align="center">
									<table width="85" cellspacing="0" cellpadding="0">
										<tr height="10">
											<td></td>
										</tr>
										<tr>
											<td width="18">&nbsp;<!-- 이모티콘 자리 --></td>
										</tr>
									</table>
									<!-- 수신자 선택 -->
									<table width="132" cellspacing="0" cellpadding="0">
										<tr height="15">
											<td></td>
										</tr>
										<tr height="16">
											<td width="52">총<input class="input3" type="text" name="inwon" readOnly maxLength="5" size="3" value="0">명</td>
											<td width="80" align="right"></td>
										</tr>
										<tr height="3">
											<td></td>
										</tr>
										<tr height="18">
											<td>수신번호</td>
											<td align="right"><input type="text" name="imsinum" size="12" maxlength="12" onKeyUp="javascript:numOnly(this);"></td>
										</tr>
										<tr height="1">
											<td></td>
										</tr>
										<tr height="18">
											<td align="center" width="132" colspan="2"><a href="javascript:subins();"><img src="img/btn10.gif" border="0" align="absMiddle"></a>&nbsp;&nbsp;&nbsp;<a href="javascript:subdel();"><img src="img/btn10_del.gif" border="0" align="absMiddle"></a></td>
										</tr>
										<tr height="1">
											<td></td>
										</tr>
										<tr>
											<td colspan="2"><select multiple style="BORDER-RIGHT:#727272 1px solid; BORDER-TOP:#727272 1px solid; BORDER-LEFT:#727272 1px solid; WIDTH:132px; BORDER-BOTTOM:#727272 1px solid; HEIGHT:56px" name="GROUP">	</select></td>
										</tr>
									</table>
									<!-- 수신자 선택 끝 -->
									<!-- 회신자 번호 입력 -->
									<table width="132" cellspacing="0" cellpadding="0">
										<tr height="1">
											<td></td>
										</tr>
										<tr>
											<td>회신번호</td>
											<td align="right"><input type="text" name="strCallBack" size="12" maxlength="14"></td>
										</tr>
									</table>
									<!-- 회신자 번호 입력 끝 -->
									<!-- 즉시예약전송방법 선택 -->
									<table width="135" cellspacing="0" cellpadding="0">
										<tr height="6">
											<td></td>
										</tr>
										<tr>
											<td><input type="radio" name="NOWLATER" value="NOW" CHECKED style="WIDTH:12px; HEIGHT:12px"
											class="tt" onclick="javascript:clickhandler('NOW');"> 즉시전송 <input type="radio" name="NOWLATER" value="LATER" style="WIDTH:12px; HEIGHT:12px" class="tt"
											onclick="javascript:clickhandler('LATER');"> 예약전송</td>
										</tr>
									</table>
									<!-- 즉시예약전송방법 선택 끝 -->
									<!-- 즉시전송 시작 -->
									<div id="phone01">
									<table width="132" cellspacing="0" cellpadding="0">
										<tr height="34">
											<td></td>
										</tr>
<?
######## 회원 로그인 체크 #######
if ($userid == "" || is_null($userid)) {

	echo "<tr>";
	echo "<td align='center'><a href=\"javascript:alert('회원 로그인 시간이 만료되었거나 회원 로그인을 안하셨습니다.\n\n회원 로그인을 하신후 SMS 서비스를 이용해 주세요!!');\"><img src='img/btn8.gif' border='0' align='absMiddle' id='IMG1'></a></td>";
	echo "</tr>";

} else {

	echo "<tr>";
	echo "<td align='center'><a href=\"javascript:Check(document.MsgForm);\"><img src='img/btn8.gif' border='0' align='absMiddle'></a></td>";
	echo "</tr>";

}
?>
										<tr>
											<td height="4"></td>
										</tr>
									</table>
									</div>
									<!-- 즉시전송 끝 -->
									<!-- 예약전송 시작 -->
									<div id="phone02" STYLE='DISPLAY:none'>
									<table width="135" cellspacing="0" cellpadding="0">
										<tr height="3">
											<td></td>
										</tr>
										<tr>
											<td align="center"><input type="text" name="rsvYear" style="BORDER-RIGHT:#727272 1px solid; BORDER-TOP:#727272 1px solid; BORDER-LEFT:#727272 1px solid; WIDTH:35px; BORDER-BOTTOM:#727272 1px solid; HEIGHT:18px" value="<? echo Date(Y); ?>" onKeyUp="javascript:numOnly(this);">년&nbsp;<input type="text" name="rsvMonth" style="BORDER-RIGHT:#727272 1px solid; BORDER-TOP:#727272 1px solid; BORDER-LEFT:#727272 1px solid; WIDTH:20px; BORDER-BOTTOM:#727272 1px solid; HEIGHT:18px" value="<? echo Date(m); ?>" onKeyUp="javascript:numOnly(this);">월&nbsp;<input type="text" name="rsvDay" style="BORDER-RIGHT:#727272 1px solid; BORDER-TOP:#727272 1px solid; BORDER-LEFT:#727272 1px solid; WIDTH:18px; BORDER-BOTTOM:#727272 1px solid; HEIGHT:18px" value="<? echo Date(d); ?>" onKeyUp="javascript:numOnly(this);">일</td>
										</tr>
										<tr height="8">
											<td></td>
										</tr>
										<tr align="center">
											<td><input type=text style="BORDER-RIGHT:#727272 1px solid; BORDER-TOP:#727272 1px solid; BORDER-LEFT:#727272 1px solid; WIDTH:20px; BORDER-BOTTOM:#727272 1px solid; HEIGHT:18px" NAME="rsvHour"  VALUE="<? echo Date(H); ?>" class="input"  maxlength=2 onKeyUp="javascript:numOnly(this);">시&nbsp;<input type=text style="BORDER-RIGHT:#727272 1px solid; BORDER-TOP:#727272 1px solid; BORDER-LEFT:#727272 1px solid; WIDTH:20px; BORDER-BOTTOM:#727272 1px solid; HEIGHT:18px" NAME="rsvMinute" VALUE="<? echo Date(i); ?>" class="input"  maxlength=2 onKeyUp="javascript:numOnly(this);">분</td>
										</tr>
									</table>
									<table width="132" cellspacing="0" cellpadding="0">
										<tr height="10">
											<td></td>
										</tr>
<?
######## 회원 로그인 체크 #######
if ($userid == "" || is_null($userid)) {

	echo "<tr>";
	echo "<td align='center'><a href=\"javascript:alert('회원 로그인 시간이 만료되었거나 회원 로그인을 안하셨습니다.\n\n회원 로그인을 하신후 SMS 서비스를 이용해 주세요!!');\"><img src='img/btn8.gif' border='0' align='absMiddle'></a></td>";
	echo "</tr>";

}else {

	echo "<tr>";
	echo "<td align='center'><a href=\"javascript:Check(document.MsgForm);\"><img src='img/btn8.gif' border='0' align='absMiddle'></a></td>";
	echo "</tr>";

}
?>
										<tr>
											<td height="4"></td>
										</tr>
									</table>
									</div>
									<!-- 예약전송 끝 -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="170"></td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
</body>

</html>
