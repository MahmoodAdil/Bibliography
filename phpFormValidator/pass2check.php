<?php
if(isSet($_POST['pass2']))
{

    $pass2 = $_POST['pass2'];

    if($pass2 == "")
    {
       echo '<font color="red">Confirm Password <STRONG>does not matched</STRONG>.</font>';              
    }
    else{
        echo 'OK';
    }

}

?>
