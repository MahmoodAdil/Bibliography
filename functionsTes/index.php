
<html>
<body>

<h1>Welcome to my home page!</h1>
<p>Some text.</p>
<p>Some more text.</p>

<?php 
//include "functions.php";

function checkTwoPasswords($PasswordInput)
{
	if($PasswordInput[0]  == $PasswordInput[1] )
	{
		return 1;
	}
    else return 0;
}
function checkUsernameAvailability($UsernameInput)
{//some code
}


;?>

<?php
$password1 ="Adil";
$password2 ="AdilMahmood";
$passwords = array($password1, $password2);
$TwoPasswordResult = checkTwoPasswords($passwords);

echo "TwoPasswordResult = " . ( $TwoPasswordResult ? "true" : "false" ); 

echo "<br />";
if($TwoPasswordResult == true){
	echo "password matched.";
}
else echo "password does not matched!.";
echo "<br />";
?>


<?php include 'footer.php';?>
</body>
</html>