<?php

  /* 클래스 파일 로드 */
  include "Sendmail.php";

  /* 클래스 객체 변수 선언 */
  $sendmail = new Sendmail();

  /*
  + $path : 파일의 절대 경로
  + $name : 파일의 이름을 설정
  + $ctype : 메일 컨텐츠 타입 (옵션값으로 기본값은 application/octet-stream 이다 )

  $path="test.txt";
  $name="example.txt";
  $ctype="application/octet-stream";

  /* 첨부파일 추가
  $sendmail->attach($path,$name,$ctype);
  */

  /*
  + $to : 받는사람 메일주소 ( ex. $to="hong <hgd@example.com>" 으로도 가능)
  + $from : 보내는사람 이름
  + $subject : 메일 제목
  + $body : 메일 내용
  + $cc_mail : Cc 메일 있을경우 (옵션값으로 생략가능)
  + $bcc_mail : Bcc 메일이 있을경우 (옵션값으로 생략가능)
  */

  $to="hy1392@koreatech.ac.kr"; // $to=array('hong1@example.com','hong2@example.com');
  $from="Master";
  $subject="[KOSTAY] 지금 당신에게 맞는 집이 등록되었습니다!";
  $body="[KOSTAY] 지금 당신에게 맞는 집이 등록되었습니다!<br>"."바로 확인하세요!<br>"."http://kostay.net";
  //$cc_mail="hy1392@koreatech.ac.kr";
  //$bcc_mail="bcc@example.com";

  /* 메일 보내기 */
  $sendmail->send_mail($to, $from, $subject, $body, $cc_mail);
?>
