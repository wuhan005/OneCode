<?php

	include_once("config.php");	//import config file.

	$onecode = $_POST["onecode"].$_salt;
	$onecode = hash("sha256", $onecode);
	
	$returnJSON = array();
	
	$jsonFile = json_decode(file_get_contents("OneCode.json"));
	
	$codeHash = $jsonFile -> ONECODE;
	$codeUsed = $jsonFile -> USED;
    $codeTime = $jsonFile -> TIME;
	$codeErrorTime = $jsonFile -> ERRORTIME;
	
	$interval = floor((strtotime(date("Y-m-d H:i:s",intval(time())))-strtotime($codeTime))%86400/60);	//Calculate the time interval.

	if($interval <= 5){
		//Check the time.
		if($codeErrorTime < 3){
			//Check the password times.
			if(($onecode == $codeHash) && ($codeUsed == false) ){
				//Check the password.
				$returnJSON['CODE'] = 200;
				$returnJSON['Message'] = "OK";
				$jsonFile -> USED = TRUE;
				file_put_contents('OneCode.json', json_encode($jsonFile));
				echo json_encode($returnJSON);
			
			}else{
			
				$returnJSON['CODE'] = 501;
				$returnJSON['Message'] = "Authorization Error!";
				$jsonFile -> ERRORTIME++;
				file_put_contents('OneCode.json', json_encode($jsonFile));
				echo json_encode($returnJSON);
			}
		}else{
				$returnJSON['CODE'] = 502;
				$returnJSON['Message'] = "The Key is Not Available.";
				echo json_encode($returnJSON);
		}
	}else{
		$returnJSON['CODE'] = 503;
		$returnJSON['Message'] = "Overtime!";
		echo json_encode($returnJSON);
	}
?>