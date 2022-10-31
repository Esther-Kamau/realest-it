<?php
//mpesa  
include "landlord_header.php";
include "nav.php";

function isAssoc(array $arr){
    if (array() === $arr) return false;
    return array_keys($arr) !== range(0, count($arr) - 1);
}

function getAccessToken($consumer_key, $consumer_secret){
    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';//access toekn request url
   $keys_separater=":";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    $credentials = base64_encode($consumer_key.$keys_separater.$consumer_secret);// a base64 
    //encoding of consumer secret and consumer key separated by :
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Basic '.$credentials)); //setting a custom header
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);					
    $curl_response = curl_exec($curl);
    $data = json_decode($curl_response, true);
    $accessToken= $data['access_token'];
    return $accessToken;
}

function getPassword($Shortcode, $Passkey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'){
    //be found here : https://developer.safaricom.co.ke/test_credentials
    if(empty($Shortcode)){
        return "System_detected_empty_parameter";
        exit();  
    }else{
    $Timestamp = date('Ymdhis');//timestamp 
    $Password = base64_encode($Shortcode.$Passkey.$Timestamp);
    return $Password;
    }
}
function preparePostData($Shortcode, $Password, $callback, array $transactionData){
   if(!is_array($transactionData)){
       return "Bad_transaction_data_format_array_expected";
       exit();
   }elseif(count($transactionData) > 4){
        return "Transaction_data_too_long_for_the_system";
        exit();
   }elseif(isAssoc($transactionData)==true){
        return "Transaction_data_is_associative_sequential_expected";
        exit();
   }elseif(count($transactionData) < 4){
        return "Transaction_data_too_short_for_the_system";
        exit();
   }elseif(empty($Shortcode) || empty($Password) || empty($callback) || empty($transactionData)){
        return "System_detected_empty_parameter";
        exit();
   }else{
        $customerPhone=$transactionData[0];
        $payAmt=$transactionData[1];
        $acRef=$transactionData[2];
        $transDesc=$transactionData[3];
        $Timestamp = date('Ymdhis');   //timestamp
    $curl_post_data = array(
        "BusinessShortCode" => $Shortcode,//business receiving payment, paybill number
        "Password" => $Password,    //a base 64 encode of shortcode, passkey and timestamp
        "Timestamp" => $Timestamp,     //time in Ymdhis formart
        "TransactionType" => "CustomerPayBillOnline",
        "Amount" => $payAmt,    //amount charged
        "PartyA" => $customerPhone,   //customer
        "PartyB" => $Shortcode,   //business receiving payment
        "PhoneNumber" => $customerPhone,    //customer
        "CallBackURL" => $callback,      //use https://developer.safaricom.co.ke for test
        "AccountReference" => $acRef,     //transaction ref.. can be invoice number
        "TransactionDesc" => $transDesc
    );

    return $curl_post_data;
 }
}
function InitiatePayRequest($curl_post_data, $accessToken){
    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';//test url
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$accessToken)); //access token from previous request
    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    $res = json_decode($curl_response);
    return $res;
}
function RegisterHTTPUrl($shortCode, $confirmURL, $validateURL, $accessToken){  
    $url = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$accessToken)); //setting custom header
    $curl_post_data = array(
      'ShortCode' => $shortCode,
      'ResponseType' => 'JSON',
      'ConfirmationURL' => $confirmURL,
      'ValidationURL' => $validateURL
    );
    $data_string = json_encode($curl_post_data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
    $curl_response = curl_exec($curl);
    $resp = json_decode($curl_response);
    return $resp;
}

require_once("classes/auth/class.OAuth.php");
if (isset($_POST['pay_rent'])) {
    $sql = "SELECT * FROM `house` WHERE `id` = '".$_POST['house_id']."'";
    $getrentsql = mysqli_query($con , $sql);
    $getrent = mysqli_fetch_assoc($getrentsql);

#universal
define("CALLBACK", "https://patrickwaweru.xyz/callback.php");
$CALLBACK= "https://patrickwaweru.xyz/callback.php";
define("MPESA_KEY", "FzLntefcy8q56S8cn6MawWMIpDr3ARar");
define("MPESA_SECRET", "ncY1zknkT54aeyjW");
$MPESA_PHONE = $_POST['phone_number'];
$Amt = $getrent['rent'];
$paybill = 174379;
$acc_no = 13244;
$transactionDesc = 'Test payment';
$transactionData = array($MPESA_PHONE, $Amt, $acc_no, $transactionDesc);
$URLresponse = RegisterHTTPUrl($paybill, $CALLBACK, $CALLBACK, getAccessToken(MPESA_KEY, MPESA_SECRET));
$post_data = preparePostData($paybill, getPassword($paybill), CALLBACK, $transactionData);
$response = InitiatePayRequest($post_data, getAccessToken(MPESA_KEY, MPESA_SECRET));

print_r($response);

$MerchantRequestID=$response->MerchantRequestID;
$CheckoutRequestID=$response->CheckoutRequestID;
$ResponseCode=$response->ResponseCode;
$ResponseDescription=$response->ResponseDescription;
$CustomerMessage=$response->CustomerMessage;
 
if($ResponseCode == 0){
    echo "Success";
//  INSERT INTO `payment`(`payment_id`, `tenant_id`, `merchant_id`, `checkout_id`, `response_code`, `response_description`, `customer_message`, `result_code`, `result_description`, `ref_no`, `amount`, `pay_from`, `pay_to`, `date`) 
// VALUES ('[value-1]','[value-2]','[value-3]','[value-4]','[value-5]','[value-6]','[value-7]','[value-8]','[value-9]','[value-10]','[value-11]','[value-12]','[value-13]','[value-14]')
}
else{
    echo "Transcaction Failed! Check if you have enough funds in your account or this is a valid phone number";
}
}