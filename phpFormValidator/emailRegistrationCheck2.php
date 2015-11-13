<?php

require_once "../database.php";
//connect to our db
$db = new Db();



if(isSet($_POST['email'])){

    $emailResult=$db->emailComfirmation($_POST['email']);
    //$emailResult = "test";

    if($emailResult == "email-validation-ok"){
        echo 'OK';
    }elseif ($emailResult == "email-already-registered"){
        echo '<font color="red">This email is already registered!.</font>'; 
    }else{
        echo '<font color="red">Please enter a valid email!.</font>';
    }
    
}
?>
