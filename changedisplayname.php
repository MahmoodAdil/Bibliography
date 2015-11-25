<?php
	include "core/header.php";

	require_once "database.php";
	include "core/lock.php";
	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";//side menue
	//connect to our db
	$db = new Db();
	// $email = $_SESSION['user_login'];
	if(isset($_POST["changedisplayname"])){
	    $db->changeDisplayName($_POST);
	}
?>
	
	
	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Change your Display Name</div>
						<div class="panel-body">
								<form role="form" id="usersAccountForm" name="usersAccountForm" action="changedisplayname.php" method="POST">
									<fieldset>
										<div class="form-group">
											<label>E.Mail</label>
											<input class="form-control" type="text" name="email" value="<?php echo $_SESSION["user_login"];?>" readonly>
										</div>
										<div class="form-group">
											<label>Name</label>
											<input class="form-control" placeholder="New Name" name="displayname" type="text" value="" required>
										</div>
										<button class="btn btn-lg btn-primary" name="changedisplayname" id="changedisplayname" type="submit">Submit</button>
									</fieldset>
								</form>
						</div><!-- panel-body -->
				</div>
			</div>
		</div><!--/.row-->
</div>
		
		


<!-- include footer	 -->							
<?php include "core/footer.php";?>		
</div>	<!--/.main-->
<?php 
include "core/scriptsFiles.php";
// include "core/footer.php";
?>	