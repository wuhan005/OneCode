<?php
    
	include_once("config.php");	//import config file.

	$token = $_POST["token"];
	$key = $_POST["key"];
	
	$trueToken = $_token;	//The true token.

	$jsonFile = json_decode(file_get_contents("OneCode.json"));

	$codeUsed = $jsonFile -> USED;
    $codeTime = $jsonFile -> TIME;

	$returnJSON = array();
	
	if($codeUsed == "false"){
		if($token == $trueToken && $key == $_key){
    		$oneCode = rand(100000,999999);
			$oneCodeEncrypt = $oneCode.$_salt;
			$oneCodeEncrypt = hash("sha256", $oneCodeEncrypt);	//Hash the OneCode.
			
			$onceCodeJSON = array();
			$onceCodeJSON['ONECODE'] = $oneCodeEncrypt;
			$onceCodeJSON['TIME'] = date("Y-m-d H:i:s",intval(time()));
			$onceCodeJSON['USED'] = "false";
			$onceCodeJSON['ERRORTIME'] = 0;
			file_put_contents('OneCode.json', json_encode($onceCodeJSON));
			
			$returnJSON['CODE'] = 200;
			$returnJSON['Message'] = "OK";
			$returnJSON['oneCode'] = $oneCode;
			
			echo json_encode($returnJSON);
			
    	}else{
			
			$returnJSON['CODE'] = 501;
			$returnJSON['Message'] = "Authorization Error!";
			
			echo json_encode($returnJSON);
		}
	}
?>