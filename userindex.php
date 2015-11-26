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

	//create a new library form handler
	if(isset($_POST["createNewLibrary"])){
	    $db->createNewLibrary($_POST);
	}
	//edit library form handler
	if(isset($_POST["editExistingLibrary"])){
	    $db->changeLibraryName($_POST);
	}
	//delete library form handler
	if(isset($_POST["deleteExistingLibrary"])){
	    $db->deleteLibrary($_POST);
	}
	
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Welcome</div>
					<?php
					if (isset($_SESSION['library_created'])) {
						?><p class="bg-success"><?php echo $_SESSION['library_created'];
						unset($_SESSION['library_created']); ?></p>
						<?php
					}
					if (isset($_SESSION['library_changed'])) {
						?><p class="bg-success"><?php echo $_SESSION['library_changed'];
						unset($_SESSION['library_changed']); ?></p>
						<?php
					}
					if (isset($_SESSION['library_delete'])) {
						?><p class="bg-success"><?php echo $_SESSION['library_delete'];
						unset($_SESSION['library_delete']); ?></p>
						<?php
					}
					?>
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
