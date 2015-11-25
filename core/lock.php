<?php

	if(!isset($_SESSION['user_login']) && !empty($_SESSION['user_login']))
	{header('Location: signin.php');//signin required
	}
?>