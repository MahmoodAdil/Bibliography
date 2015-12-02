<?php
	include "core/header.php";

	require_once "database.php";

	include "core/topheader.php";//topheader bar
	include "core/sidenavigation.php";//side menue
	
	if (isset($_SESSION['user_login']))
	{header('Location:userindex.php');//alreadylogin
	}
	//connect to our db
	$db = new Db();
	if(isset($_POST["usersAccountSignin"])){
	    $db->userSignin($_POST);
	}
?>

<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				
				<div class="panel-heading">Signin</div>
				<div class="panel-body">
					<?php

					if (isset($_SESSION['signin_error'])){
						?><p class="bg-danger"><?php echo "The email address or password you entered is not valid"; ?></p>
						<?php
					}
					if (isset($_SESSION['email_sent'])) {
						unset($_SESSION['email_sent']);
						?><p class="bg-success"><?php echo "A verification email has been sent."; ?></p>
						<?php
					}
					?>
					<form role="form" id="usersAccountForm" name="usersAccountForm" action="signin.php" method="POST">
						<fieldset>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" placeholder="Password" name="password" type="password" value="" min="5" required>
							</div>
							<button class="btn btn-lg btn-primary" name="usersAccountSignin" id="usersAccountSignin" type="submit">Submit</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Create new account</div>
				<div class="panel-body">
				<a class="btn btn-default" href="signup.php" role="button">Signup</a>
				</div>
			</div>
		</div>
	</div>
	
<?php 
include "core/scriptsFiles.php";
include "core/footer.php";
?>	
