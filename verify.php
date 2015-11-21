<?php
require_once "database.php";
	//connect to our db
	$db = new Db();
	if(isset($_GET['email']))
	{
	    $email=($_GET['email']);
	    $db->usersAccountVarify($email);
	}
	else{
		echo '<font color="red"><h1>Something went wrong!</h></font>';
		if (isset($_SESSION['email_error']))
		{
			unset($_SESSION['email_error']);
			echo '<font color="red"><h1>Something went wrong!</h></font>';
		}
	}
?>