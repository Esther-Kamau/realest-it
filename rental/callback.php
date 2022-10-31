<?php
$postData = file_get_contents('php://input');
    
$json=json_decode($postData, true);

                $MerchantRequestID= $json['Body']['stkCallback']['MerchantRequestID'];
				$CheckoutRequestID= $json['Body']['stkCallback']['CheckoutRequestID'];
				$ResultCode= $json['Body']['stkCallback']['ResultCode'];
				$ResultDesc= $json['Body']['stkCallback']['ResultDesc'];
				$Items= $json['Body']['stkCallback']['CallbackMetadata']['Item'];
                $transaction_code= '';
				// Printing all the keys and values one by one
				$keys = array_keys($Items);
				for($i = 0; $i < count($Items); $i++) {
                    $name= $json['Body']['stkCallback']['CallbackMetadata']['Item'][$i]['Name'];
					$value= $json['Body']['stkCallback']['CallbackMetadata']['Item'][$i]['Value'];
					
					if($name==='Amount'){
					$amount= $value;
					}
					if($name==='MpesaReceiptNumber'){
					$transaction_code= $value;
					}
					if($name==='TransactionDate'){
						$transaction_date = $value;
					}
					if($name==='PhoneNumber'){
						$phone= $value;
					}
				}
                UPDATE `payment` SET `result_code`='$ResultCode',`result_description`='$ResultDesc',`ref_no`='$transaction_code'
                 WHERE `merchant_id`= '$MerchantRequestID' and `checkout_id`='$CheckoutRequestID'

                // $file = fopen("log.txt", "w"); 
                //url fopen should be allowed for this to occur
//perform your processing here, e.g. log to file....
// if(fwrite($file, $MerchantRequestID) === FALSE)
// {
//     fwrite("Error: no data written");
// }

// fwrite("\r\n");
// fclose($file);
?>
