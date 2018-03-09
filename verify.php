<?php
$access_token = 'Ip6MJjyoP0dcHir4z+9KEL3CHaTihlfZRplDRvhZ8UJm0ujD81yEnODHWL9BAEN6PuR2zmB4aJ4R/fjLU+eykzyjda5iSmB09na+iOXd3CO930zdBJj2TxqelnJjWQTggWVVhvdL3Oq/G5mtlnIHXQdB04t89/1O/w1cDnyilFU=';
$url = 'https://api.line.me/v1/oauth/verify';
$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
echo $result;
?>
