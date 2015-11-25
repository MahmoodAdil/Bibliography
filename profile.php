<?php
	include "core/header.php";
	require_once "database.php";
	include "core/lock.php";	
	//connect to our db
	$db = new Db();


	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";
	
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Welcome</div>
					<?php
					if (isset($_SESSION['password_error'])) {
							unset($_SESSION['password_error']);
						}
					if (isset($_SESSION['password_changed'])) {
						?><p class="bg-success"><?php echo $_SESSION['password_changed'];
						unset($_SESSION['password_changed']); ?></p>
						<?php
					}
					if (isset($_SESSION['displayname_changed'])) {
						?><p class="bg-success"><?php echo $_SESSION['displayname_changed'];
						unset($_SESSION['displayname_changed']); ?></p>
						<?php
					}
					?>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Profile</div>
						<div class="panel-body">
								<form role="form" id="usersAccountForm" name="usersAccountForm" action="changedisplayname.php" method="POST">
									<fieldset>
										<div class="form-group">
											<label>E.Mail</label>
											<p class="form-control-static"><?php echo $_SESSION["user_login"];?></p>
										</div>
										<div class="form-group">
											<label>Name</label>
											<p class="form-control-static"><?php echo $_SESSION["user_displayname"];?></p>
										</div>
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
