<?php

	include "core/header.php";
	require_once "database.php";
	//connect to our db
	$db = new Db();
	
if (isset($_SESSION['signin_error']))
{
	unset($_SESSION['signin_error']);
}
?>
<h1>OK</h1>