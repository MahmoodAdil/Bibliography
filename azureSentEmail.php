<?php 
require 'PHPMailer/PHPMailerAutoload.php';
echo "string";
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                          // Enable verbose debug output
$domainname= "http://bibliography.azurewebsites.net";
$emailToSent='adil.mahmood.2012@mumail.ie';
$mail->isSMTP();                                        // Set mailer to use SMTP 
$mail->Host = 'smtp.sendgrid.net';             // Specify main/backup SMTP servers 
$mail->SMTPAuth = true;                           // Enable SMTP authentication 
$mail->Username = 'azure_cdf577451af1ffd1d93f2d69ce47caa2@azure.com';//'YOUR USERNAME';    // SMTP username 
$mail->Password = 'SLDLSLKsdsd45345';//'YOUR PASSWORD';    // SMTP password 
$mail->SMTPSecure = 'tls';                        // Enable TLS/SSL encryption 
$mail->Port = 587;                                      // TCP port to connect to

$mail->From = '143net4u@gmail.com'; 
$mail->FromName = 'Bibliography Manager'; 
$mail->addAddress('adil143m@gmail.com', $emailToSent,"CC: adil143m@gmail.com";);     // Add a recipient

$mail->WordWrap = 50;                              // Set word wrap to 50 characters 
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Email Verification'; 
$mail->Body    = '
                    <p>Thanks for signing up!</p>
                    <p>Your account has been created, you can login with the following credentials after you have activated</p>
                    <p>your account by pressing the url below.</p>
                 	
                    <b><p>Please click this link to activate your account:</p></b>
                   
                    '.$domainname.'/verify.php?email='.$emailToSent.'.';

if(!$mail->send()) { 
    echo 'Message could not be sent.'; 
    echo 'Mailer Error: ' . $mail->ErrorInfo; 
} else { 
    echo 'Message has been sent'; 
}

?>