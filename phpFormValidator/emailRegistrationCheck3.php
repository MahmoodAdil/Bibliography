<?php

//include 'databaseForvalidator.php';

require_once "../database.php";
//connect to our db
$db = new Db();

if(isSet($_POST['email'])){
$email = $_POST['email'];
    {
      $errorcode = "alreadyUsed1jhjkhk";
        if($errorcode == "alreadyUsed1")
        {
           echo '<font color="red">This email is already registered.</font>';              
        }
        else{
            echo 'OK';
        }
    }


}
?>
