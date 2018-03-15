<?php
function responseText($text) {
	if(strpos($text, ' ') !== false) {
		//Have parameter
		list($command,$parameter) = explode(" ", $text,2);
	} else {
		//No parameter
		$command=$text;
		$parameter="";
	}
	$reply="";
	echo "command=".$command."<br/>";
	echo "parameter=".$parameter."<br/>";
	echo "<HR>";
	switch($command) {
		case "test";
		case "try";
			$reply="เอาจริงดิ";
			break;
		case "ping" :
			if($parameter!=="") {
				echo "ping ".$parameter."<br/>";
				$reply=exec("ping -n 1 ".$parameter);
			} else {
				$reply="Error";
			}
			break;
		default :
			$reply="คุณไม่สังกัด Shop นี้";
	}
	return $reply;
}

function responseLocation($latitude,$longitude) {
	$reply=$latitude.",".$longitude;
	return $reply;
}
?>
