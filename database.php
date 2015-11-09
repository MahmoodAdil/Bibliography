<?php
session_start();
class Db {
    
    protected $con;
    private $host = "localhost";//"eu-cdbr-azure-west-c.cloudapp.net";
    private $user = "root";//"bbafb55bdffce4";
    private $pwd = "";//"5a4ecc10";
    private $db = "bibliographyDB";//"TecLogLog";
    
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
                        //signup successfull redirect to signin page
                        //header("location:index.php");
                }
                elseif ($passone != $passtwo) {
                    $_SESSION['password_error']="Both password are not same";
                }
                elseif ($emailCheck == "email-already-registered") {
                    $_SESSION['email_error']="this email is already registered";
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
    
}
?>

            