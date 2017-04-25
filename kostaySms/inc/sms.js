

/* 문자열공백 제거 */
function trim(str) {
	return replace(str," ","");
}

/* 문자열에 있는 특정문자패턴을 다른 문자패턴으로 바꾸는 함수. */
function replace(targetStr, searchStr, replaceStr) {
	var len, i, tmpstr;

	len = targetStr.length;
	tmpstr = "";

	for ( i = 0 ; i < len ; i++ ) {
		if ( targetStr.charAt(i) != searchStr ) {
			tmpstr = tmpstr + targetStr.charAt(i);
		} else {
			tmpstr = tmpstr + replaceStr;
		}
	}
	return tmpstr;
}

/* 숫자 입력 체크 */
function numOnly(obj,frm) {
	if (event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39) return;
	var returnValue = "";
	for (var i = 0; i < obj.value.length; i++) {
		if (parseInt(obj.value.charAt(i)) >= 0 && parseInt(obj.value.charAt(i)) <= 9){
			returnValue += obj.value.charAt(i);
		}
	}

	obj.value = returnValue;
}

/* 해상도에 관계없이 화면 중앙에 새창 띄우기 */
function MidWindow(url,winname,features) {

	features = features.toLowerCase();
	len = features.length;
	sumchar= '';

	for(i=1; i <= len; i++){	// 빈칸 제거
		onechar = features.substr(i-1, 1);
		if(onechar != ' ') sumchar += onechar;
	}

	features = sumchar;
	sp = new Array();
	sp = features.split(',', 10);	// 배열에 옵션을 분리해서 입력
	splen = sp.length;	// 배열 갯수

	for(i=0; i < splen; i++){	// width, height 값을 구하기 위한 부분
		if(sp[i].indexOf('width=') == 0){	// width 값일때
			width = Number(sp[i].substring(6));
		} else if (sp[i].indexOf('height=') == 0){	// height 값일때
			height = Number(sp[i].substring(7));
		}
	}

	sleft = (screen.width - width) / 2-100;
	stop = (screen.height - height) / 2+100;
	features = features + ',left=' + sleft + ',top=' + stop;
	popwin = window.open(url,winname,features);
}

/*  문자 메시지 문자수 계산 */
function ChkLen() {
	var tmpStr;
	var temp=0;
	var onechar;
	var tcount;
	tcount = 0;

	tmpStr = new String(document.MsgForm.strMsg.value);
	temp = tmpStr.length;

	for (k=0;k<temp;k++) {
		onechar = tmpStr.charAt(k);
		if (escape(onechar) =='%0D') { } else if (escape(onechar).length > 4) { tcount += 2; } else { tcount++; }
	}

	// 필드선택에 따른 제한값 변경하기

	MsgForm.msg_txt_cnt.value = tcount;

	if(tcount > 80) {

		reserve = tcount-80;

		alert("내용은 80바이트 이상은 입력 하실수 없습니다.\r\n 입력하신 내용은 "+reserve+"바이트가 초과되었습니다.\r\n 초과된 부분은 자동으로 삭제됩니다.");
		cutText();
		return;
	}

	return tcount;
}

function cutText() {
	nets_check(document.MsgForm.strMsg.value);
}

function nets_check(aquery) {

	var tmpStr;
	var temp=0;
	var onechar;
	var tcount;
	tcount = 0;

	tmpStr = new String(aquery);
	temp = tmpStr.length;

	for(k=0;k<temp;k++) {
		onechar = tmpStr.charAt(k);

		if(escape(onechar).length > 4) {
			tcount += 2;
		} else {
			// 엔터값이 들어왔을때 값(\r\n)이 두번실행되는데 첫번째 값(\n)이 들어왔을때 tcount를 증가시키지 않는다.
			if(escape(onechar)=='%0A') {
			} else {
				tcount++;
			}
		}

		if(tcount>80) {
			tmpStr = tmpStr.substring(0,k);
			break;
		}

	}
	document.MsgForm.strMsg.value = tmpStr;
	ChkLen(tmpStr);
}


/*  개별 주소 입력 */
function subins() {

// 입력력수신번호 공백체크
	if (document.MsgForm.imsinum.value=="") {
		document.MsgForm.imsinum.focus();
		return;
	}

	// 주소박스 주소갯수 체크후 수신자 인원 체크
	var len = document.MsgForm.GROUP.length;
	var tel = document.MsgForm.imsinum.value;

	for (i=0;i<len;i++) {
		if(document.MsgForm.GROUP[i].value == tel) {
			return;
		}
	}

	if(document.createElement) {
		var op = document.createElement("OPTION");
		op.text = tel ;
		op.setAttribute("value", tel);
		op.setAttribute("selected", false);
	} else {
		var op=new Option(tel,tel,false,false);
	}

	document.MsgForm.GROUP[len] = op;
	document.MsgForm.imsinum.value = '';
	document.MsgForm.inwon.value = len+1;
}

/*  주소록박스 선택 주소 입력 */
function multi_subins(in_value){

	if(trim(in_value) != ''){
	var cur_tel = '';

	in_value = trim(in_value);

		for(i=0; i<in_value.length ;i++) {

			if(in_value.charAt(i) == '\;') {

				var len = document.MsgForm.GROUP.length;

				if(document.createElement) {
					var op = document.createElement("OPTION")
					op.text = cur_tel ;
					op.setAttribute("value", cur_tel)
					op.setAttribute("selected", false)
				} else {
					var op=new Option(cur_tel,cur_tel,false,false)
				}
				document.MsgForm.GROUP[len] = op;
				cur_tel = '';

			}else{
				cur_tel += in_value.charAt(i);
			}
		}
	}
	document.MsgForm.inwon.value = document.MsgForm.GROUP.length;
}

/*  입력 주소 삭제 */
function subdel(){

	var len = document.MsgForm.GROUP.length;

	for(i=0;i<document.MsgForm.GROUP.length;i++) {
		if(document.MsgForm.GROUP[i].selected == true) {
			document.MsgForm.GROUP.options[i] = null;
			i--;
			document.MsgForm.inwon.value = document.MsgForm.GROUP.length;
		}
	}
}

/* 전송 방법 선택(즉시 예약 전송에 따른 핸드폰 바탕패턴이미지 불러오기,  즉시 예약 전송에 따른 입력 포맷 결정)  */
function clickhandler(mode)
{

	if (mode=="NOW")
	{
		document.all.backimg.background="img/phone_01.gif";
		document.all.phone01.style.display="block";
		document.all.phone02.style.display="none";
	} else if (mode=="LATER") {
		document.all.backimg.background="img/phone_03.gif";
		document.all.phone01.style.display="none";
		document.all.phone02.style.display="block";
	} else {
		document.all.backimg.background="img/phone_01.gif";
		document.all.phone01.style.display="block";
		document.all.phone02.style.display="none";
	}
}

/*  전송 확인 최종 체크 */
function Check(form) {

	   if (form.msg_txt_cnt.value < 1) {
	      alert('전송할 메시지를 입력해주세요.');
	      form.strMsg.focus();
	      return;
	   }

	   if (form.msg_txt_cnt.value > 80) {
	      alert('메시지의 크기가 너무 큽니다.');
	      form.strMsg.focus();
	      return;
	   }

       if (form.GROUP.length == 0) {
	      alert('받는 분의 전화번호를 입력하세요.');
		  form.imsinum.focus();
	      return;
	   }

	   for(i=0 ; i<form.GROUP.length ; i++){
	   		form.GROUP[i].selected = true;
	   }

		if (form.NOWLATER[1].checked == true) {

			if (form.rsvYear.value == "") {
				alert("예약 년도를 입력하세요");
				return;
			} else if (form.rsvMonth.value == "") {
				alert("예약 월을 입력하세요");
				return;
			} else if (form.rsvDay.value == "") {
				alert("예약 일을 입력하세요");
				return;
			} else if (form.rsvHour.value == "") {
				alert("예약 시간을 입력하세요");
				return;
			} else if (form.rsvMinute.value == "") {
				alert("예약 분을 입력하세요");
				return;
			}

			if ( form.rsvMonth.value < 0 ||  form.rsvMonth.value > 12 ) {
				alert("예약날짜중 월이 잘못입력되었습니다");
				return;
			}

			if ( form.rsvDay.value < 0 || form.rsvDay.value > 31 ) {
				alert("예약날짜중 일이 잘못입력되었습니다");
				return;
			}

			if ( form.rsvHour.value < 0 || form.rsvHour.value >= 24 ) {
				alert("예약날짜중 시간이 잘못입력되었습니다");
				return;
			}

			if ( form.rsvMinute.value < 0 || form.rsvMinute.value >= 60 ) {
				alert("예약날짜중 분이 잘못입력되었습니다");
				return;
			}
		}

	   if(confirm('전송하시겠습니까?')){

			var arrGR = new Array();

			for(i=0; i<form.GROUP.length; i++) {
				var arrValue = "";
				arrValue = form.GROUP.options[i].value;
				arrGR.push(arrValue);
				form.arrCallNo.value = arrGR;
			}

			form.submit();
	   }
	}

