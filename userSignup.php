<?php

require_once "database.php";
//connect to our db
$db = new Db();

?>
<html>
<HEAD>




<link rel="stylesheet" type="text/css" href="style.css" />


</HEAD>

 <BODY>
<center>

<div align="center">

<h2 align="center">Assignment Work</h2>

<center>Practical</STRONG></center><br /><br />
 
<?php

require_once "database.php";
//connect to our db
$db = new Db();
if(isset($_POST["usersAccountSubmit"])){
    $db->usersAccountSignup($_POST);
}
//if error sessions
if (isset($_SESSION['password_error'])) {
  echo $_SESSION['password_error'];
  session_destroy(); 
}
else if (isset($_SESSION['email_error'])) {
  echo $_SESSION['email_error'];
  session_destroy(); 
}

?>

 <form id="usersAccountForm" name="usersAccountForm" action="userSignup.php" method="POST">
  <table width="700" border="0">  
    <tr>
      <td width="200"><div align="right">Display Name:&nbsp;</div></td>
      <td width="100"><input id="displayname" size="20" type="text" name="displayname" title="Display Name any!." required></td>
      <td width="400" align="left"><div id="displayname"></div></td>
    </tr> 
    <tr>
      <td width="200"><div align="right">E Mail:&nbsp;</div></td>
      <td width="100"><input id="email" size="20" type="email" name="email"  required></td>
      <td width="400" align="left"><div id="emailstatus"></div></td>
    </tr> 

    <tr>
      <td width="200"><div align="right">Password:&nbsp;</div></td>
      <td width="100"><input size="20" type="password" name="pass1" id="pass1"  title="Choose Password" minlength=6 required></td>
      <td width="400" align="left"><div id="pass1status"></div></td>
    </tr> 

    <tr>
      <td width="200"><div align="right">Confirm Password:&nbsp;</div></td>
      <td width="100"><input size="20" type="password" name="pass2" id="pass2" minlength=6 required></td>
      <td width="400" align="left"><div id="pass2status"></div></td>
    </tr> 
<tr>
      <td width="200"></td>
      <td width="100"></td>
      <td width="400" align="left"><div id="status"> <input  name="usersAccountSubmit" id="usersAccountSubmit" type="submit" value="Submit"></div></td>
    </tr> 
  </table>
</form>

</div>
 </center>

<script type="text/javascript" src="javascripts/jquery-1.2.6.min.js"></script>
<script type="text/javascript" src="javascripts/usernameAvailabilityChecker.js"></script>

<script type="text/javascript" src="javascripts/emailRegistrationChecker.js"></script>
 <script type="text/javascript" src="javascripts/password1Checker.js"></script>
 <script type="text/javascript" src="javascripts/passwordMatchingChecker2.js"></script>

 </BODY>
</HTML>