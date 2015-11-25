<?php
	include "core/header.php";
	include "core/lock.php";
	require_once "database.php";
	
	//connect to our db
	$db = new Db();
	
	if (isset($_SESSION['signin_error']))
	{
		unset($_SESSION['signin_error']);
	}

	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";
	
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Welcome</div>
				</div>
			</div>
		</div><!--/.row-->
		
		


<!-- include footer	 -->							
<?php include "core/footer.php";?>		
</div>	<!--/.main-->


		
	
<?php 
include "core/scriptsFiles.php";
// include "core/footer.php";
?>	
