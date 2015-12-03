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
    // private $pwd = "ficXpKVdAN5";
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
        // function for drop usersaccount table
    public function dropTableusersaccount() {
        try {
            $sql = "DROP TABLE usersaccount;";
            $this->con->query($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
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
        // function for drop dropTablelibrary table
    public function dropTablelibrary() {
        try {
            $sql = "DROP TABLE library;";
            $this->con->query($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
        public function createSharedLibraryTable() {
            try {
                $sql = "CREATE TABLE IF NOT EXISTS sharedlibrary (
                        rowIndex INT(11) AUTO_INCREMENT,
                        idoflibrary INT(11) NOT NULL,
                        sharewithemail VARCHAR(265) NOT NULL,
                        PRIMARY KEY(rowIndex)
                        );";
                $this->con->query($sql);
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                }
        }//END function sharedLibrary()
        // function for drop Tablesharedlibrary table
    public function dropTablesharedlibrary() {
        try {
            $sql = "DROP TABLE sharedlibrary;";
            $this->con->query($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
        public function createReferenceTable() {
            try {
                $sql = "CREATE TABLE IF NOT EXISTS reference (
                        id INT(11) AUTO_INCREMENT,
                        idoflibrary INT(11) NOT NULL,
                        title VARCHAR(265),
                        author VARCHAR(265),
                        keyword VARCHAR(265),
                        year VARCHAR(4),
                        abstract text,
                        PRIMARY KEY(id)
                        );";
                $this->con->query($sql);
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                }
        }//END createReferenceTable sharedLibrary()
        // function for drop Tablesharedlibrary table
    public function dropTablereference() {
        try {
            $sql = "DROP TABLE reference;";
            $this->con->query($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
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
            $emailCheckResult = $emailCheck->isEmailVarify($email,'0');
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
    public function isEmailVarify($email,$verify) {
        try{
                $query = $this->con->prepare("SELECT email FROM usersaccount WHERE email = :email AND verify =:verify;");
                $query->bindParam(':email', $email);
                $query->bindParam(':verify', $verify);
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
    public function createNewLibrary($newLibrary) {
        try {
                           
                //Create a newlibraries
                $amandable='1';
                
                $query = $this->con->prepare("INSERT INTO library (displayname,owneremail,amandable) VALUES (:displayname,:owneremail,:amandable);");
                $query->bindParam(':displayname',$newLibrary['displayname']);
                $query->bindParam(':owneremail', $newLibrary['email']);
                $query->bindParam(':amandable', $amandable);
                $query->execute();
                $_SESSION['library_created']="New library is created.";header("location:userindex.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }// createNewLibrary END
    public function changeLibraryName($libraryNewName) {
        try{
            $Libraryid=$_POST['Libraryid'];
            $newdisplayname=$_POST['newdisplayname'];
                $query = $this->con->prepare("UPDATE library 
                SET 
                  displayname = :newdisplayname
                WHERE id= '$Libraryid'");

                $query->bindParam(':newdisplayname', $newdisplayname);
                $query->execute();
                $_SESSION['library_changed']="Library name has been changes.";header("location:userindex.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }         
        
    }
    //function for fetch all notes from table notes order by last modified date
    public function getUserLibrary($userEmail,$amandable){
        try{
            $query = $this->con->prepare("SELECT id, displayname FROM library WHERE owneremail = :owneremail AND amandable =:amandable ORDER BY id ASC;");
            $query->bindParam(':owneremail', $userEmail);
            $query->bindParam(':amandable', $amandable);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //function for fetch all notes from table notes order by last modified date
    public function getUserOwnLibrary($userEmail){
        try{
            $query = $this->con->prepare("SELECT id, displayname FROM library WHERE owneremail = :owneremail ORDER BY id ASC;");
            $query->bindParam(':owneremail', $userEmail);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //function for fetch all notes from table notes order by last modified date
    public function getLibraryOwner($userEmail,$libraryid){
        try{
            $query = $this->con->prepare("SELECT id, owneremail FROM library WHERE id=:id AND owneremail = :owneremail AND displayname !='Trash';");
            $query->bindParam(':id', $libraryid);
            $query->bindParam(':owneremail', $userEmail);
            $query->execute();
            return count($query->fetchAll()) > 0;//is true
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    //function for fetch all notes from table notes order by last modified date
    public function getActiceLibraryName($ActiveLibraryid){
        try{
            $query = $this->con->prepare("SELECT displayname FROM library WHERE id = :ActiveLibraryid;");
            $query->bindParam(':ActiveLibraryid', $ActiveLibraryid);
            $query->execute();
            return $query->fetch()[0];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
      //delete existing library
    public function deleteLibrary($libraryID){
        try{
            $libraryid=$_POST['libraryid'];
            $query = $this->con->prepare("DELETE FROM library WHERE id = :libraryid;");
            $query->bindParam(':libraryid', $libraryid);
            $query->execute();
            $_SESSION['library_delete']="Library has been deleted.";header("location:userindex.php");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
      //delete existing library
    public function ShareActiveLibrary($ShareLibrary){
        try{//check user is owner of active library so do it share else error
            $sharewithemail=$_POST['sharewithemail'];
            $activelibraryid=$_POST['activelibraryid'];
            $emailCheck = new Db();
            $emailCheckResult = $emailCheck->isEmailVarify($sharewithemail,'1');
            $LibraryOwner = new Db();
            $LibraryOwnerResult = $LibraryOwner->getLibraryOwner($_SESSION["user_login"],$activelibraryid);//check is you are the owner of library
            
            
            if ($sharewithemail ==$_SESSION["user_login"]) {
                $_SESSION['library_shere_error']="Ohoo its your own email, try again with different email!, ";header("location:userindex.php");
            }elseif ($LibraryOwnerResult !='1') {
                $_SESSION['library_shere_error']="Ohoo you can not share this library! ";header("location:userindex.php");
            }
            elseif(($emailCheckResult == "email-OK") AND($sharewithemail !=$_SESSION["user_login"])AND($LibraryOwnerResult =='1'))
            {
                $query = $this->con->prepare("INSERT INTO sharedlibrary (idoflibrary,sharewithemail) VALUES (:idoflibrary,:sharewithemail);");
                $query->bindParam(':idoflibrary',$activelibraryid);
                $query->bindParam(':sharewithemail', $sharewithemail);
                $query->execute();

                $_SESSION['library_shere_success']="Your Library is shared with, ".$sharewithemail;header("location:userindex.php");
            }else{
                $_SESSION['library_shere_error']="This Emil is not registered or verifyed, ".$sharewithemail;header("location:userindex.php");
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
     public function addRefToLibrary($refdata) {
        try {
                $query = $this->con->prepare("INSERT INTO reference (idoflibrary,title,author,year,keyword,abstract) VALUES (:idoflibrary,:title,:author,:year,:keyword,:abstract);");
                $query->bindParam(':idoflibrary',$refdata['idoflibrary']);
                $query->bindParam(':title', $refdata['title']);
                $query->bindParam(':author', $refdata['author']);
                $query->bindParam(':year', $refdata['year']);
                $query->bindParam(':keyword', $refdata['keyword']);
                $query->bindParam(':abstract', $refdata['abstract']);
                $query->execute();
                $_SESSION['ref_added']="Reference is added!";header("location:addrefrencetolibrary.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }// createNewLibrary END
    public function editRefToLibrary($refdata) {
        try {
                 $id=$refdata['editid'];
                 //echo "string".$id;
                $query = $this->con->prepare("UPDATE reference 
                SET 
                  title = :newtitle,
                  author = :newauthor,
                  year = :newyear,
                  keyword=:newkeyword,
                  abstract = :newabstract
                WHERE id= '$id'");
                  $query->bindParam(':newtitle', $refdata['title']);
                  $query->bindParam(':newauthor', $refdata['author']);
                 $query->bindParam(':newyear', $refdata['year']);
                 $query->bindParam(':newkeyword', $refdata['keyword']);
                 $query->bindParam(':newabstract', $refdata['abstract']);
                $query->execute();
                $_SESSION['refrence_edited']="Refrence has been changes.";header("location:userindex.php");
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }// createNewLibrary END
    //function for fetch all notes from table notes order by last modified date
    public function getRefrence($refrenceid){
        try{
            $query = $this->con->prepare("SELECT * FROM reference WHERE id = :refrenceid;");
            $query->bindParam(':refrenceid', $refrenceid);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//getRefrence END owneremail= :owneremail ;");
    public function getAllRefrence($sorting){//getAllRefrence($email){
        try{
            if(isset($_POST["sortby"])){
                $columnname=$_POST['columnname'];
                 $orderby=$_POST['orderby'];
            }
            else{
                $columnname='year';
                $orderby='DESC';
            }

            $trashid=($_SESSION["user_trashid"]);
            $owneremail=($_SESSION["user_login"]);
            $query = $this->con->prepare("SELECT * FROM library,reference WHERE library.owneremail= :owneremail AND reference.idoflibrary=library.id AND reference.idoflibrary!=:trashid ORDER BY $columnname $orderby;");
            $query->bindParam(':trashid', $trashid);
            $query->bindParam(':owneremail', $owneremail);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//getRefrence END
     public function getTrashRefrence($sorting){//getAllRefrence($email){
        try{
            if(isset($_POST["sortby"])){
                $columnname=$_POST['columnname'];
                 $orderby=$_POST['orderby'];
            }
            else{
                $columnname='year';
                $orderby='DESC';
            }

            $trashid=($_SESSION["user_trashid"]);
            $query = $this->con->prepare("SELECT * FROM reference WHERE idoflibrary=:idoflibrary ORDER BY $columnname $orderby;");
            $query->bindParam(':idoflibrary', $trashid);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//TrashList END
    public function deleterefrence($refid){
        try{
            $trashid=($_SESSION["user_trashid"]);
            //$deleteid=$refid['deleteid'];
                 //echo "string".$id;
                $query = $this->con->prepare("UPDATE reference 
                SET 
                  idoflibrary = :idoflibrary
                WHERE id= '$refid'");
                  $query->bindParam(':idoflibrary', $trashid);
                $query->execute();
                $_SESSION['refrence_deleted']="Refrence has been Deleted! Temprary Refrence moved to Trash.";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//deleterefrence END
    public function deletereTrash($deleteid){//delete selected refrences rom trash
        try{
            $query = $this->con->prepare("DELETE FROM reference WHERE id= :deleteid;");
            $query->bindParam(':deleteid', $deleteid);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//deleterefrence END
    public function emptyTrash($trashid){//delete all refrence from trash
        try{
            $query = $this->con->prepare("DELETE FROM reference WHERE idoflibrary= :idoflibrary;");
            $query->bindParam(':idoflibrary', $trashid);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//emptyTrash END
    //function for get max id from notes table
    public function getTrashID() {
        try{      
            $owneremail=($_SESSION["user_login"]); 
            $libraryName='Trash';
            $query = $this->con->prepare("SELECT id FROM library WHERE owneremail= :owneremail AND displayname=:displayname;");
            $query->bindParam(':owneremail', $owneremail);
            $query->bindParam(':displayname', $libraryName);
            $query->execute();
            return $query->fetch()[0];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    public function getShareList(){//getShareList 
        try{
            
            $owneremail=($_SESSION["user_login"]);
            $query = $this->con->prepare("SELECT * FROM sharedlibrary,library WHERE library.owneremail= :owneremail AND library.id=sharedlibrary.idoflibrary;");
            $query->bindParam(':owneremail', $owneremail);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//getShareList END
     public function unshareLibrarywith($LibrowIndex){//delete all refrence from trash
        try{
            $query = $this->con->prepare("DELETE FROM sharedlibrary WHERE rowIndex= :rowIndex;");
            $query->bindParam(':rowIndex', $LibrowIndex);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//unshareLibrarywith END
    public function searchLibraries($searchPram){//getShareList 
        try{
            $searchauthor=ltrim($searchPram['searchauthor']);
            $searchtitle=ltrim($searchPram['searchtitle']);
            $searchyear=ltrim($searchPram['searchyear']);
            // $selectedLibraries[]=$searchPram['selectedLibraries'];


            foreach($_POST['selectedLibraries'] as $item){
                $selectedLibraries=$item;
            }
            $query = $this->con->prepare("SELECT * FROM reference WHERE author LIKE '%$searchauthor%' OR title LIKE '%$searchtitle%' OR year LIKE '%$searchyear%' AND idoflibrary='$selectedLibraries';");
           // $query->bindParam(':author', $searchauthor);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }//searchLibraries END
}
?>