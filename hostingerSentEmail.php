<?php 
		$domainname='http://bibliography.esy.es/';
		$to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = '
                    Thanks for signing up!
                    Your account has been created, you can login with the following credentials after you have activated 
                    your account by pressing the url below.
                 
                    Please click this link to activate your account:
                   
                    '.$domainname.'/verify.php?email='.$email.'';
                    // Add the content headers
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    
                    $headers = "From: webmaster@bibliography.esy.es" . "\r\n" .
                                "CC: adil143m@gmail.com";
                          

        mail($to,$subject,$message,$headers);
?>