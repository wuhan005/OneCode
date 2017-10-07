<?php

	include_once("config.php");	//import config file.

	$onecode = $_POST["onecode"].$_salt;
	$onecode = hash("sha256", $onecode);
	
	$returnJSON = array();
	
	$jsonFile = json_decode(file_get_contents("OneCode.json"));
	
	$codeHash = $jsonFile -> ONECODE;
	$codeUsed = $jsonFile -> USED;
    $codeTime = $jsonFile -> TIME;
	
	$interval = floor((strtotime(date("Y-m-d H:i:s",intval(time())))-strtotime($codeTime))%86400/60);	//Calculate the time interval.

	if($interval <= 5){
		if($onecode == $codeHash){
			$returnJSON['CODE'] = 200;
			$returnJSON['Message'] = "OK";
			echo json_encode($returnJSON);
			
		}else{
			
			$returnJSON['CODE'] = 233;
			$returnJSON['Message'] = "Authorization Error!";
			echo json_encode($returnJSON);
		}
	}else{
		$returnJSON['CODE'] = 666;
		$returnJSON['Message'] = "Overtime!";
		echo json_encode($returnJSON);
	}
?>