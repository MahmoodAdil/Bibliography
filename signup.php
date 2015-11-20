<?php
	include "core/header.php";
	require_once "database.php";
	//connect to our db
	$db = new Db();
	if(isset($_POST["usersAccountSignup"])){
	    
	    $db->usersAccountSignup($_POST);
	}
?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				
				<div class="panel-heading">Signup new account</div>
				<div class="panel-body">
				<?php
				if (isset($_SESSION['email_error'])) {
					unset($_SESSION['email_error']);
					?><p class="bg-warning"><?php echo "This email is already registered!"; ?></p>
					<?php
				}
				elseif (isset($_SESSION['password_error'])) {
					unset($_SESSION['password_error']);
					?><p class="bg-warning"><?php echo "Both password are not same."; ?></p>
					<?php
				}
				?>
					<form role="form" id="usersAccountForm" name="usersAccountForm" action="signup.php" method="POST">
						<fieldset>
						<div class="form-group">
								<label>Name</label>
								<input class="form-control" placeholder="Display Name" name="displayname" type="text" autofocus=""required>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" placeholder="Password" name="pass1" type="password" value="" min="5" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" placeholder="Retype Password" name="pass2" type="password" value="" required>
							</div>
							<button class="btn btn-lg btn-primary" name="usersAccountSignup" id="usersAccountSignup" type="submit">Submit</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Already have account</div>
				<div class="panel-body">
				<a class="btn btn-default" href="userSignin.php" role="button">Signin</a>
				</div>
			</div>
		</div>
	</div>


<?php 
include "core/scriptsFiles.php";
include "core/footer.php";
?>	

