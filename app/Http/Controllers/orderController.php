<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\paytmKit\configPaytm;
use App\User;  

class orderController extends Controller
{

	protected $configPaytm;
	protected $endecPaytm;
	protected $users;

	public function __construct()
	{
		$this->configPaytm = new configPaytm();		
		
		$this->users = new User();
	}

    public function placeOrder( Request $request )
    {
    	//$userId = $this->users->id;
    	$ORDER_ID = uniqid();
		$TXN_AMOUNT = $request->price;
		$TRANSCTION_ID = MD5(rand(0, 9999));
		$data = $this->handlePaymentRequest( $TXN_AMOUNT, $ORDER_ID );
		$paramList = $data['paramList'];
		$checkSum  = $data['checkSum'];
		return view('paytmResponse', compact('PAYTM_TXN_URL', 'paramList', 'checkSum'));
    }

    public function handlePaymentRequest( $TXN_AMOUNT, $ORDER_ID )
    {
    	$this->configPaytm->config();
    	$this->endec_paytm();
    	$paramList["MID"] = PAYTM_MERCHANT_MID;
		$paramList["ORDER_ID"] = $ORDER_ID;
		$paramList["CUST_ID"] = $ORDER_ID."bjhbxh";
		$paramList["INDUSTRY_TYPE_ID"] = 'Retail';
		$paramList["CHANNEL_ID"] = 'WEB';
		$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
		$paramList["WEBSITE"] = PAYTM_MERCHANT_WEBSITE;
		$paramList["CALLBACK_URL"] = url('/paytmResponseCall');
		$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);

		return array(
			'paramList' => $paramList,
			'checkSum'  => $checkSum
		);
    }

    public function paytmResponseCallback( Request $request )
    {
    	$this->configPaytm->config();
    	$this->endec_paytm();
    	$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";
		$paytmChecksum = isset($request->CHECKSUMHASH) ? $request->CHECKSUMHASH : ""; //Sent by Paytm pg
		$isValidChecksum = verifychecksum_e($paramList, PAYTM_MERCHANT_KEY, $paytmChecksum);
		if($isValidChecksum == "TRUE") {
			echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
			if ($request['STATUS'] == "TXN_SUCCESS") {
				echo "<b>Transaction status is success</b>" . "<br/>";

				//Process your transaction here as success transaction.
				//Verify amount & order id received from Payment gateway with your application's order id and amount.
			}
			else {
				echo "<b>Transaction status is failure</b>" . "<br/>";
			}

			// if (isset($request) && count($request)>0 )
			// { 
			// 	foreach($request as $paramName => $paramValue) {
			// 			echo "<br/>" . $paramName . " = " . $paramValue;
			// 	}
			// }
			

		}
		else {
			echo "<b>Checksum mismatched.</b>";
			//Process transaction as suspicious.
		}
    }

    public function endec_paytm()
    {

    	function encrypt_e($input, $ky) {
		$key   = html_entity_decode($ky);
		$iv = "@@@@&&&&####$$$$";
		$data = openssl_encrypt ( $input , "AES-128-CBC" , $key, 0, $iv );
		return $data;
		}

		function decrypt_e($crypt, $ky) {
			$key   = html_entity_decode($ky);
			$iv = "@@@@&&&&####$$$$";
			$data = openssl_decrypt ( $crypt , "AES-128-CBC" , $key, 0, $iv );
			return $data;
		}

		function generateSalt_e($length) {
			$random = "";
			srand((double) microtime() * 1000000);

			$data = "AbcDE123IJKLMN67QRSTUVWXYZ";
			$data .= "aBCdefghijklmn123opq45rs67tuv89wxyz";
			$data .= "0FGH45OP89";

			for ($i = 0; $i < $length; $i++) {
				$random .= substr($data, (rand() % (strlen($data))), 1);
			}

			return $random;
		}

		function checkString_e($value) {
			if ($value == 'null')
				$value = '';
			return $value;
		}

		function getChecksumFromArray($arrayList, $key, $sort=1) {
			if ($sort != 0) {
				ksort($arrayList);
			}
			$str = getArray2Str($arrayList);
			$salt = generateSalt_e(4);
			$finalString = $str . "|" . $salt;
			$hash = hash("sha256", $finalString);
			$hashString = $hash . $salt;
			$checksum = encrypt_e($hashString, $key);
			return $checksum;
		}
		function getChecksumFromString($str, $key) {
			
			$salt = generateSalt_e(4);
			$finalString = $str . "|" . $salt;
			$hash = hash("sha256", $finalString);
			$hashString = $hash . $salt;
			$checksum = encrypt_e($hashString, $key);
			return $checksum;
		}

		function verifychecksum_e($arrayList, $key, $checksumvalue) {
			$arrayList = removeCheckSumParam($arrayList);
			ksort($arrayList);
			$str = getArray2StrForVerify($arrayList);
			$paytm_hash = decrypt_e($checksumvalue, $key);
			$salt = substr($paytm_hash, -4);

			$finalString = $str . "|" . $salt;

			$website_hash = hash("sha256", $finalString);
			$website_hash .= $salt;

			$validFlag = "FALSE";
			if ($website_hash == $paytm_hash) {
				$validFlag = "TRUE";
			} else {
				$validFlag = "FALSE";
			}
			return $validFlag;
		}

		function verifychecksum_eFromStr($str, $key, $checksumvalue) {
			$paytm_hash = decrypt_e($checksumvalue, $key);
			$salt = substr($paytm_hash, -4);

			$finalString = $str . "|" . $salt;

			$website_hash = hash("sha256", $finalString);
			$website_hash .= $salt;

			$validFlag = "FALSE";
			if ($website_hash == $paytm_hash) {
				$validFlag = "TRUE";
			} else {
				$validFlag = "FALSE";
			}
			return $validFlag;
		}

		function getArray2Str($arrayList) {
			$findme   = 'REFUND';
			$findmepipe = '|';
			$paramStr = "";
			$flag = 1;	
			foreach ($arrayList as $key => $value) {
				$pos = strpos($value, $findme);
				$pospipe = strpos($value, $findmepipe);
				if ($pos !== false || $pospipe !== false) 
				{
					continue;
				}
				
				if ($flag) {
					$paramStr .= checkString_e($value);
					$flag = 0;
				} else {
					$paramStr .= "|" . checkString_e($value);
				}
			}
			return $paramStr;
		}

		function getArray2StrForVerify($arrayList) {
			$paramStr = "";
			$flag = 1;
			foreach ($arrayList as $key => $value) {
				if ($flag) {
					$paramStr .= checkString_e($value);
					$flag = 0;
				} else {
					$paramStr .= "|" . checkString_e($value);
				}
			}
			return $paramStr;
		}

		function redirect2PG($paramList, $key) {
			$hashString = getchecksumFromArray($paramList);
			$checksum = encrypt_e($hashString, $key);
		}

		function removeCheckSumParam($arrayList) {
			if (isset($arrayList["CHECKSUMHASH"])) {
				unset($arrayList["CHECKSUMHASH"]);
			}
			return $arrayList;
		}

		function getTxnStatus($requestParamList) {
			return callAPI(PAYTM_STATUS_QUERY_URL, $requestParamList);
		}

		function getTxnStatusNew($requestParamList) {
			return callNewAPI(PAYTM_STATUS_QUERY_NEW_URL, $requestParamList);
		}

		function initiateTxnRefund($requestParamList) {
			$CHECKSUM = getRefundChecksumFromArray($requestParamList,PAYTM_MERCHANT_KEY,0);
			$requestParamList["CHECKSUM"] = $CHECKSUM;
			return callAPI(PAYTM_REFUND_URL, $requestParamList);
		}

		function callAPI($apiURL, $requestParamList) {
			$jsonResponse = "";
			$responseParamList = array();
			$JsonData =json_encode($requestParamList);
			$postData = 'JsonData='.urlencode($JsonData);
			$ch = curl_init($apiURL);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
			'Content-Type: application/json', 
			'Content-Length: ' . strlen($postData))                                                                       
			);  
			$jsonResponse = curl_exec($ch);   
			$responseParamList = json_decode($jsonResponse,true);
			return $responseParamList;
		}

		function callNewAPI($apiURL, $requestParamList) {
			$jsonResponse = "";
			$responseParamList = array();
			$JsonData =json_encode($requestParamList);
			$postData = 'JsonData='.urlencode($JsonData);
			$ch = curl_init($apiURL);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);                                                                  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                         
			'Content-Type: application/json', 
			'Content-Length: ' . strlen($postData))                                                                       
			);  
			$jsonResponse = curl_exec($ch);   
			$responseParamList = json_decode($jsonResponse,true);
			return $responseParamList;
		}

		function getRefundChecksumFromArray($arrayList, $key, $sort=1) {
			if ($sort != 0) {
				ksort($arrayList);
			}
			$str = getRefundArray2Str($arrayList);
			$salt = generateSalt_e(4);
			$finalString = $str . "|" . $salt;
			$hash = hash("sha256", $finalString);
			$hashString = $hash . $salt;
			$checksum = encrypt_e($hashString, $key);
			return $checksum;
		}

		function getRefundArray2Str($arrayList) {	
			$findmepipe = '|';
			$paramStr = "";
			$flag = 1;	
			foreach ($arrayList as $key => $value) {		
				$pospipe = strpos($value, $findmepipe);
				if ($pospipe !== false) 
				{
					continue;
				}
				
				if ($flag) {
					$paramStr .= checkString_e($value);
					$flag = 0;
				} else {
					$paramStr .= "|" . checkString_e($value);
				}
			}
			return $paramStr;
		}
		function callRefundAPI($refundApiURL, $requestParamList) {
			$jsonResponse = "";
			$responseParamList = array();
			$JsonData =json_encode($requestParamList);
			$postData = 'JsonData='.urlencode($JsonData);
			$ch = curl_init($apiURL);	
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_URL, $refundApiURL);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  
			$jsonResponse = curl_exec($ch);   
			$responseParamList = json_decode($jsonResponse,true);
			return $responseParamList;
		}

    }


}
