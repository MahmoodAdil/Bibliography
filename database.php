<?php
session_start();
class Db {
    
    protected $con;
    //localhost
    // private $host = "localhost";
    // private $user = "root";
    // private $pwd = "";
    // private $db = "bibliographyDB";

    //http://bibliography.azurewebsites.net/
    private $host = "eu-cdbr-azure-west-c.cloudapp.net";
    private $user = "bbafb55bdffce4";
    private $pwd ="5a4ecc10";
    private $db = "TecLogLog";
   
    //bibliography.esy.es
    // private $host = "mysql.hostinger.co.uk";
    // private $user = "u974722529_adil";
    // private $pwd = "I4aYntOBLT";
    // private $db = "u974722529_cs615";

    
    
        //Creates a PDO conection & sets error mode to exceptions
        public function __construct(){
        
            try { 
                $this->con = new PDO("mysql:host=$this->host;dbname=$this->db", $this->user, $this->pwd); 
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
                $this->con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            } 
            catch(PDOException $e) { 
                echo $e->getMessage();
            }
            
        }
    
        //sets the datab to null
        //The connection will be closed automatically when the script ends.
        public function disconect() {
            
            $this->con = null;
            
        }
        //create table if not exists
        public function createTable() {
            try {
                $sql = "CREATE TABLE IF NOT EXISTS usersaccount (
                        id INT(11) AUTO_INCREMENT,
                        displayname VARCHAR(65) NOT NULL,
                        email VARCHAR(265) NOT NULL,
                        salt VARCHAR(265) NOT NULL,
                        password VARCHAR(265) NOT NULL,
                        memberSince TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                        verify BOOL NOT NULL,
                        PRIMARY KEY(id)
                        );";
                $this->con->query($sql);
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                }
        }//END function createTable()
        public function createLibraryTable() {
            try {
                $sql = "CREATE TABLE IF NOT EXISTS library (
                        id INT(11) AUTO_INCREMENT,
                        displayname VARCHAR(65) NOT NULL,
                        owneremail VARCHAR(265) NOT NULL,
                        amandable BOOL NOT NULL,
                        PRIMARY KEY(id)
                        );";
                $this->con->query($sql);
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                }
        }//END function createTable()
        //usersAccountSignup
        public function usersAccountSignup($params) {
        try {
            $passone=$_POST['pass1'];
            $passtwo=$_POST['pass2'];
            $email=$_POST['email'];
            $emailCheck = new Db();
            $emailSent = new Db();
            $verify='0';
            $emailCheckResult = $emailCheck->emailComfirmation($email);
                if(($passone == $passtwo) && ($emailCheckResult == "email-validation-ok"))
                {
                        /******************************************************************************************/
                                define('SALT_LENGTH', 9);
                                $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
                                $password = $salt . hash("sha512", $salt . $passone);
                        /******************************************************************************************/
                        $query = $this->con->prepare("INSERT INTO usersaccount (displayname,email,salt,password,verify) VALUES (:displayname,:email,:salt,:password,:verify);");
                        $query->bindParam(':displayname', $params['displayname']);
                        $query->bindParam(':email', $params['email']);
                        $query->bindParam(':salt', $salt);
                        $query->bindParam(':password', $password);
                        $query->bindParam(':verify', $verify);
                        $query->execute();
                        //sent email for varification
                        $emailSent->emailSentToUser($email);
                        //signup successfull redirect to signin page
                        $_SESSION['email_sent']="email is sent to user";header("location:signin.php");
                }
                elseif ($emailCheckResult == "email-already-registered") {
                    $_SESSION['email_error']="this email is already registered";
                }
                elseif ($passone != $passtwo) {
                    $_SESSION['password_error']="Both password are not same";
                }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }// public function usersAccountSignup($params) END 
        public function usersAccountVarify($email) {
        try {
            $emailCheck = new Db();
            $emailCheckResult = $emailCheck->isEmailVarify($email);
            if($emailCheckResult == "email-OK")
            {
                //here is verified
                $query = $this->con->prepare("UPDATE usersaccount SET verify='1' WHERE email= '$email'");
                $query->execute();
                // echo a message to say the UPDATE succeeded
                //Create libraries for user
                $library1 = "Trash";$library2 = "Unified";$amandable='0';
                echo "string1";
                $query2 = $this->con->prepare("INSERT INTO library (displayname,owneremail,amandable) VALUES (:displayname,:owneremail,:amandable);");
                $query2->bindParam(':displayname', $library1);
                $query2->bindParam(':owneremail', $email);
                $query2->bindParam(':amandable', $amandable);
                $query2->execute();
                //Create second library
                $query3 = $this->con->prepare("INSERT INTO library (displayname,owneremail,amandable) VALUES (:displayname,:owneremail,:amandable);");
                $query3->bindParam(':displayname', $library2);
                $query3->bindParam(':owneremail', $email);
                $query3->bindParam(':amandable', $amandable);
                $query3->execute();header("location:signin.php");
            }
            else {
                $_SESSION['email_error']="E-mail error";header("location:verify.php");
            }//return back to page and show error

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }// public function usersAccountVarify END 
    public function emailComfirmation($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            try{
                $query = $this->con->prepare("SELECT email FROM usersaccount WHERE email = :email;");
                $query->bindParam(':email', $email);
                $query->execute();
                //return count($query->fetchAll()) > 0;
                 $rowcount=$query->rowCount();
                //echo " No of records = ".$rowcount;  
                if($rowcount == 1)
                {
                    //echo "email already registered";
                    return "email-already-registered";
                }
                else{
                    //echo "this email not registered";
                    return "email-validation-ok";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            }//FILTER_VALIDATE_EMAIL END
        else{
               return "email-is-not-vaild";
            }        
    }//public function emailComfirmation($email) END
    public function isEmailVarify($email) {
        try{
                $query = $this->con->prepare("SELECT email FROM usersaccount WHERE email = :email AND verify =0;");
                $query->bindParam(':email', $email);
                $query->execute();
                //return count($query->fetchAll()) > 0;
                 $rowcount=$query->rowCount();
                //echo " No of records = ".$rowcount;  
                if($rowcount == 1)
                {
                    //echo "email registered is not verifyed";
                    return "email-OK";
                }
                else{
                    //echo "this email not registered";
                    return "error";
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
                }
      
    }//public function emailComfirmation($email) END
    public function passwordStrength($pass1) {
        $pass1 = $_POST['pass1'];

        $containsLetter  = preg_match('/[a-zA-Z]/',    $pass1);
        $containsDigit   = preg_match('/\d/',          $pass1);
        $containsSpecial = preg_match('/[^a-zA-Z\d]/', $pass1);

        $containsAll = $containsLetter && $containsDigit && $containsSpecial;
        if($containsAll == false)
        {
           return "error";              
        }
        else{
            return "OK";
        }       
    }//public function emailComfirmation($email) END
    public function emailSentToUser($email) {
        //$domainname= "http://bibliography.esy.es";
        $domainname= "http://bibliography.azurewebsites.net";
        
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
                    
                    $headers = "From: webmaster@bibliography.com" . "\r\n" .
                                "CC: adil143m@gmail.com";
                          

        mail($to,$subject,$message,$headers);

        
    }//public function emailSentToUser END
    public function userSignin($signin_params) {
        try{
                
            $email=$_POST['email'];
            $temp_password=$_POST['password'];
            $query = $this->con->prepare("SELECT * FROM usersaccount WHERE email = :email AND verify =1;");
            $query->bindParam(':email', $email);
            $query->execute();
            //return count($query->fetchAll()) > 0;
             $rowcount=$query->rowCount();
            //echo " No of records = ".$rowcount;  
            if($rowcount == 1)
            {
                
                //access the every single column of row
               $row = $query->fetch(PDO::FETCH_ASSOC);
               //access the data 
               $userid=$row['id'];
               $displayname=$row['displayname'];
               $password=$row['password'];
               $salt=$row['salt'];
               //password hash with salt for compare

                $checkpass = $salt . hash("sha512", $salt . $temp_password);
                if($password == $checkpass)
                {
                    //echo'password matched';
                    /****************************************************/
                    $_SESSION['user_login']=$email;
                    $_SESSION['user_displayname']=$displayname;header("Location:userindex.php");
                }
                else{
                //      echo "    email OK password errorerror    ";
                $_SESSION['signin_error']="signin_error1";header("location:signin.php");//return back to signin page
                }
                // echo "     GOOOOOD email OK";
            }
            else{
                // echo "  email notfound error";
                $_SESSION['signin_error']="signin_error2";header("Location: signin.php");//return back to signin page
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }         
        
    }
     public function changePassword($newPassword) {
        try{
            $passone=$_POST['pass1'];
            $passtwo=$_POST['pass2'];
            $email=$_POST['email'];
            if($passone == $passtwo){
                /******************************************************************************************/
                        define('SALT_LENGTH', 9);
                        $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
                        $password = $salt . hash("sha512", $salt . $passone);
                /******************************************************************************************/
                $query = $this->con->prepare("UPDATE usersaccount 
                SET 
                  salt = :salt, 
                  password = :password
                WHERE email= '$email'");
                $query->bindParam(':salt', $salt);
                $query->bindParam(':password', $password);
                $query->execute();
                $_SESSION['password_changed']="your password has been changes.";header("location:profile.php");
            }else{
                 $_SESSION['password_error']="Both password are not same";header("location:changepassword.php");//return back to previous page
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }         
        
    }
     public function changeDisplayName($newName) {
        try{
            $email=$_POST['email'];
            $displayname=$_POST['displayname'];
                $query = $this->con->prepare("UPDATE usersaccount 
                SET 
                  displayname = :displayname
                WHERE email= '$email'");

                $query->bindParam(':displayname', $displayname);
                $query->execute();
                $_SESSION['user_displayname']=$displayname;
                $_SESSION['displayname_changed']="your displayname has been changes.";header("location:profile.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }         
        
    }
    
}
?>

            