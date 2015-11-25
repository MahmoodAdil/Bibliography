<?php
	include "core/header.php";

	require_once "database.php";
	include "core/lock.php";
	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";//side menue
	//connect to our db
	$db = new Db();
	// $email = $_SESSION['user_login'];
	if(isset($_POST["changePassword"])){
	    $db->changePassword($_POST);
	}
?>
	
	
	
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Change your password</div>
						<?php
						if (isset($_SESSION['password_error'])) {
							// unset($_SESSION['password_error']);
							?><p class="bg-warning"><?php echo "Both password are not same."; ?></p>
							<?php
						}
						?>
						<div class="panel-body">
								<form role="form" id="usersAccountForm" name="usersAccountForm" action="changepassword.php" method="POST">
									<fieldset>
										<div class="form-group">
											<label>E.Mail</label>
											<input class="form-control" type="text" name="email" value="<?php echo $_SESSION["user_login"];?>" readonly>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control" placeholder="Password" name="pass1" type="password" value="" min="5" required>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input class="form-control" placeholder="Retype Password" name="pass2" type="password" value="" required>
										</div>
										<button class="btn btn-lg btn-primary" name="changePassword" id="changePassword" type="submit">Submit</button>
									</fieldset>
								</form>
						</div><!-- panel-body -->
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