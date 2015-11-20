<?php
session_start();
class Db {
    
    protected $con;
    // private $host = "localhost";//"eu-cdbr-azure-west-c.cloudapp.net";//mysql.hostinger.co.uk
    // private $user = "root";//"bbafb55bdffce4";//u810140208_adil
    // private $pwd = "";//"5a4ecc10";//mmPnTlEw91
    // private $db = "bibliographyDB";//"TecLogLog";//u810140208_cs615
    //mapassignment.esy.es 
    private $host = "mysql.hostinger.co.uk";
    private $user = "u810140208_adil";
    private $pwd = "mmPnTlEw91";
    private $db = "u810140208_cs615";
    
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
                $sql = "CREATE TABLE IF NOT EXISTS usersAccount (
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
        //usersAccountSignup
        public function usersAccountSignup($params) {
        try {
            $passone=$_POST['pass1'];
            $passtwo=$_POST['pass2'];
            $email=$_POST['email'];
            $emailCheck = new Db();
            $emailSent = new Db();
            $emailCheckResult = $emailCheck->emailComfirmation($email);
                if(($passone == $passtwo) && ($emailCheckResult == "email-validation-ok"))
                {
                        /******************************************************************************************/
                                define('SALT_LENGTH', 9);
                                $salt = substr(md5(uniqid(rand(), true)), 0, SALT_LENGTH);
                                $password = $salt . hash("sha512", $salt . $passone);
                        /******************************************************************************************/
                        $query = $this->con->prepare("INSERT INTO usersaccount (displayname,email,salt,password) VALUES (:displayname,:email,:salt,:password);");
                        $query->bindParam(':displayname', $params['displayname']);
                        $query->bindParam(':email', $params['email']);
                        $query->bindParam(':salt', $salt);
                        $query->bindParam(':password', $password);
                        $query->execute();
                        //sent email for varification
                        $emailSent->emailSentToUser($email);
                        //signup successfull redirect to signin page
                        header("location:signin.php");
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
        
        $to = $email;
        $subject = "My subject";
        $txt = "Hello world!";
        // Add the content headers
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers = "From: webmaster@example.com" . "\r\n" .
        "CC: adil143m@gmail.com";

        mail($to,$subject,$txt,$headers);

        
    }//public function emailComfirmation($email) END
    
}
?>

            