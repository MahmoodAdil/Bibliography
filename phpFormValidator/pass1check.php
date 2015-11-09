<?php

require_once "../database.php";
//connect to our db
$db = new Db();

if(isSet($_POST['pass1'])){

    $passResult=$db->passwordStrength($_POST['pass1']);

    if($passResult == "OK"){
        echo 'OK';
    }elseif ($passResult == "error"){
        echo '<font color="red">At least one number, UPPER and lower case letters and punctuation mark!</font>'; 
    }
}
?>
