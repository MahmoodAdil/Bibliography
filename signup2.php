<!DOCTYPE html>
<?php

// If the form was submitted, scrub the input (server-side validation)
// see below in the html for the client-side validation using jQuery

$displayname = '';
$email = '';
$password = '';
if($_POST) {
  // collect all input and trim to remove leading and trailing whitespaces
  $displayname = trim($_POST['displayname']);
  $email = trim($_POST['email']);
  $pass1 = trim($_POST['pass1']);
  
  $errors = array();
  
  // Validate the input
  if (strlen($displayname) == 0)
    array_push($errors, "Please enter your name");
  
  if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    array_push($errors, "Please specify a valid email address");
    
    
  if (strlen($password) < 5)
    array_push($errors, "Please enter a password. Passwords must contain at least 5 characters.");
    
  // If no errors were found, proceed with storing the user input
  if (count($errors) == 0) {
    array_push($errors, "No errors were found. Thanks!");
  }
  
  //Prepare errors for output
  $output = '';
  foreach($errors as $val) {
    $output .= "<p class='output'>$val</p>";
  }
  
}

?>
<html>
<head>
    <!-- Define some CSS -->
  <style type="text/css">
    .label {width:100px;text-align:right;float:left;padding-right:10px;font-weight:bold;}
    #register-form label.error, .output {color:#FB3A3A;font-weight:bold;}
  </style>
  
  <!-- Load jQuery and the validate plugin -->
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
  
  <!-- jQuery Form Validation code -->
  <script>
  
  // When the browser is ready...
  $(function() {
  
    // Setup form validation on the #register-form element
    $("#register-form").validate({
    
        // Specify the validation rules
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            username: "required",
            password: {
                required: true,
                minlength: 5
            }
        },
        
        // Specify the validation error messages
        messages: {
            name: "Please enter your name",
            email: "Please enter a valid email address",
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            }
        },
        
        submitHandler: function(form) {
            form.submit();
        }
    });

  });
  
  </script>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>

<?php
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
					<!-- <form role="form" id="usersAccountForm" name="usersAccountForm" action="signup2.php" method="POST"> -->
						<form action="" method="post" id="register-form" novalidate="novalidate">
						<fieldset>
						<div class="form-group">
								<div class="label">Name</div>
								<input class="form-control" placeholder="Display Name" name="displayname" type="text" autofocus="">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" placeholder="Password" name="pass1" type="password" value="">
							</div>
							<div class="form-group">
								<label>Password</label>
								<input class="form-control" placeholder="Retype Password" name="pass2" type="password" value="">
							</div>
							<input type="submit" name="submit" value="Submit" />
							<!-- <button class="btn btn-lg btn-primary" name="usersAccountSignup" id="usersAccountSignup" type="submit">Submit</button> -->
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

	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
