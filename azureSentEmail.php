<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "1";
 $url = 'https://api.sendgrid.com/';
 $user = 'adil';
 $pass = 'CS615Assignment'; 

 $params = array(
      'api_user' => $user,
      'api_key' => $pass,
      'to' => 'adil143m@gmail.com',
      'subject' => 'testing from curl',
      'html' => 'testing body',
      'text' => 'testing body',
      'from' => 'adil143m@hotmail.com',
   );

 $request = $url.'api/mail.send.json';

 // Generate curl request
 $session = curl_init($request);
echo "2";
 // Tell curl to use HTTP POST
 curl_setopt ($session, CURLOPT_POST, true);

 // Tell curl that this is the body of the POST
 curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

 // Tell curl not to return headers, but do return the response
 curl_setopt($session, CURLOPT_HEADER, false);
 curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
echo "3";
 // obtain response
 $response = curl_exec($session);
 curl_close($session);
echo "4";
 // print everything out
 print_r($response);
 echo "5";
 ?>