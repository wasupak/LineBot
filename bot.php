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

$access_token = 'Ip6MJjyoP0dcHir4z+9KEL3CHaTihlfZRplDRvhZ8UJm0ujD81yEnODHWL9BAEN6PuR2zmB4aJ4R/fjLU+eykzyjda5iSmB09na+iOXd3CO930zdBJj2TxqelnJjWQTggWVVhvdL3Oq/G5mtlnIHXQdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {	
    //Validate User
    $uid=$event['source']['userId'];
    switch($event['message']['type']) {
      case "text" :
        echo "Process message<br/>";
        // Get text sent
        $text = $event['message']['text'];			
        //$reply=responseText($text);
	$reply="Text";
        break;
      case "location" :
        echo "Process location<br/>";
        $latitude = $event['message']['latitude'];
        $longitude = $event['message']['longitude'];
        //$reply=responseLocation($latitude,$longitude);
    	$reply="Lat/Long";
        break;
      default :
        echo "Unsupport event type";
    }
	
    $replyToken = $event['replyToken'];	
  
    //$messages[]=array('type' => 'text','text' => $uid);
    //$messages[]=array('type' => 'text','text' => $reply);
    $messages=['type' => 'text','text' => $reply];
    // Make a POST Request to Messaging API to reply to sender			
    $url = 'https://api.line.me/v2/bot/message/reply';			
    //$data = ['replyToken' => $replyToken,'messages' => $messages];
    $data = ['replyToken' => $replyToken,'messages' => [$messages]];
    $post = json_encode($data);			
    $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);			
    $ch = curl_init($url);			
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");			
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);			
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);			
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);			
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);			
    $result = curl_exec($ch);			
    curl_close($ch);			
    echo $result . "";		
}
echo "OK";
?>
