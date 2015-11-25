<?php
	session_start();
	//if user is loged in
	if(isset($_SESSION['user_login']))
	{		
		/// remove all session variables
	 session_unset();
	 unset($_SESSION['user_login']);
	 header('Location: index.php');
	}else{
		header('Location: index.php');//redirect to index
	}
?>