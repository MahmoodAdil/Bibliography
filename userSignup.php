<!DOCTYPE html>
<html>
<head>
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
	<script>
	var validateForm ='';
	//Boolean(validateForm);
	</script>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Signup new account</div>
				<div class="panel-body">
					<!-- <form role="form"> -->
					<form id="usersAccountForm" name="usersAccountForm" action="userSignup.php" method="POST">
						
						 <table class="table-condensed">
						  <tr>
					      <td width="300"><div align="right">Name:&nbsp;</div></td>
					      <td width="100"><input id="displayname" size="20" type="text" name="displayname" title="Display Name any!."></td>
					      <td width="400" align="left"><!-- <div class="validation-status"> --></div></td>
					    </tr> 
					    <tr>
					      <td width="300"><div align="right">E Mail:&nbsp;</div></td>
					      <td width="100"><input id="email" size="20" type="email" name="email"></td>
					      <td width="400" align="left"><div class="validation-status"></div></td>
					    </tr> 

					    <tr>
					      <td width="300"><div align="right">Password:&nbsp;</div></td>
					      <td width="100"><input size="20" type="password" name="pass1" id="pass1"  title="Choose Password"></td>
					      <td width="400" align="left"><div class="validation-status"></div></td>
					    </tr> 

					    <tr>
					      <td width="200"><div align="right">Password:&nbsp;</div></td>
					      <td width="100"><input size="20" type="password" name="pass2" id="pass2"></td>
					      <td width="400" align="left"><div class="validation-status"></div></td>
					    </tr> 
					<tr>
					      <td width="200"></td>
					      <td width="100"></td>
					      <td width="400" align="left">
					       <!--script>
						 // //    var validateForm = true;
							// // Boolean(validateForm);
							// if (validateForm == true) {document.write('<button class="btn btn-lg btn-primary" name="usersAccountSubmit" id="usersAccountSubmit" type="submit">Submit</button>');}
							// else{document.write('<button  type="button" class="btn btn-lg btn-primary" disabled="disabled">Submit</button>');};
							// </script -->
					      <button class="btn btn-lg btn-primary" name="usersAccountSubmit" id="usersAccountSubmit" type="submit">Submit</button>
					      </td>
					    </tr> 
						</table>
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
	
	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script type="text/javascript" src="javascripts/signupFormValidatin1.js"></script>
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
