<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once '../../server/dbconnect.php';
require_once('iamport.php');
extract($_POST);

$iamport = new Iamport('4504462543738766', 'irWO4FAxgEWFgbbJwX4lFLWwceGPlEtE5qsa52HmGE1WPcGlaLHPwElJS1yeG1SMskXymFU3jV098Gvj');

#1. imp_uid 로 주문정보 찾기(아임포트에서 생성된 거래고유번호)
$result = $iamport->findByImpUID($_GET['imp_uid']); //IamportResult 를 반환(success, data, error)
if ( $result->success ) {
	/**
	*	IamportPayment 를 가리킵니다. __get을 통해 API의 Payment Model의 값들을 모두 property처럼 접근할 수 있습니다.
	*	참고 : https://api.iamport.kr/#!/payments/getPaymentByImpUid 의 Response Model
	*/
	$payment_data = $result->data;
	echo '## 결제정보 출력 ##';
	echo '가맹점 주문번호 : ' 	. $payment_data->merchant_uid;
	echo '결제상태 : ' 		. $payment_data->status;
	echo '결제금액 : ' 		. $payment_data->amount;
	echo '결제수단 : ' 		. $payment_data->pay_method;
	echo '결제된 카드사명 : ' 	. $payment_data->card_name;
	echo '결제 매출전표 링크 : '	. $payment_data->receipt_url;
	/**
	*	IMP.request_pay({
	*		custom_data : {my_key : value}
	*	});
	*	와 같이 custom_data를 결제 건에 대해서 지정하였을 때 정보를 추출할 수 있습니다.(서버에는 json encoded형태로 저장합니다)
	*/
	echo 'Custom Data :'	. $payment_data->getCustomData('tar');
    echo 'Custom Data :'	. $payment_data->getCustomData('amount');
	# 내부적으로 결제완료 처리하시기 위해서는 (1) 결제완료 여부 (2) 금액이 일치하는지 확인을 해주셔야 합니다.
	$amount_should_be_paid = $payment_data->getCustomData('amount');
    echo "\n".( $payment_data->status === 'paid' && $payment_data->amount === $amount_should_be_paid ).",";
	if ( $payment_data->status === 'paid' && $payment_data->amount === $amount_should_be_paid ) {
		//TODO : 결제성공 처리
      $list=$payment_data->getCustomData('tar');
        $list2 = explode(",",$list);
        for($i=0;$i<count($list2);$i++){
            if(strlen($list2[$i])>0){
                $check = "select * from search where house_id='".$list2[$i]."'";
                $checkr = mysqli_query($conn,$check);
                $checkrow = mysqli_fetch_array($checkr);
                $today = date("Y-m-d", time());
                $tdiff = strtotime($today)-strtotime($checkrow['pay']);
                $tdiff = $tdiff/86400;
                if($checkrow['pay']==NULL || $tdiff>365){
                    $adQuery = "update search set pay=now(), pay_count=0 where house_id='".$list2[$i]."'";
                }
                else{
                      $modify_day = date("Y-m-d", strtotime($checkrow['pay']."+365days"));
                    echo $modify_day;
                    $adQuery = "update search set pay_count=".($checkrow['pay_count']+1)." where house_id='".$list2[$i]."'";
                }
                $adResult = mysqli_query($conn, $adQuery);    
            }
        } 
	}
} else {
	error_log($result->error['code']);
	error_log($result->error['message']);
}
//echo "<script>location.href='../../pay-adv-detail.html'</script>";
?>
