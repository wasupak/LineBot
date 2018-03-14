<?php
$access_token = 'Ip6MJjyoP0dcHir4z+9KEL3CHaTihlfZRplDRvhZ8UJm0ujD81yEnODHWL9BAEN6PuR2zmB4aJ4R/fjLU+eykzyjda5iSmB09na+iOXd3CO930zdBJj2TxqelnJjWQTggWVVhvdL3Oq/G5mtlnIHXQdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {	
// Loop through each event	
  foreach ($events['events'] as $event) {		
  // Reply only when message sent is in 'text' format		
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {			
    // Get text sent			
    $text = $event['message']['text'];			
    // Get replyToken			
    $replyToken = $event['replyToken'];			
    // Build message to reply back			
    if($text=='keyword') {
      $messages = ['type' => 'text','text' => "ตอบตาม keyword \uDBC0\uDC84 0x100078 \0x100078"];			
    } else {
      $messages = ['type' => 'text','text' => $text];			
    }
   
    // Make a POST Request to Messaging API to reply to sender			
    $url = 'https://api.line.me/v2/bot/message/reply';			
    $data = ['replyToken' => $replyToken,'messages' => [$messages],];			
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
  }
}
echo "OK";
?>
