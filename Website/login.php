<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['user'])!="")
{
 header("Location: home.php");
}
if(isset($_POST['btn-login']))
{
 $email = mysql_real_escape_string($_POST['email']);
 $upass = mysql_real_escape_string($_POST['pass']);
 $res=mysql_query("SELECT * FROM Users WHERE Email='$email'");
 $row=mysql_fetch_array($res);
 if($row['Password']==md5($upass))
 {
  $_SESSION['user'] = $row['user_id'];
  header("Location: home.php");
 }
 else
 {
  ?>
        <script>alert('wrong details');</script>
        <?php
 }
 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Fitness Diary - Log in</title>
  <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/stylesheet.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

	<div class="page-header" style="text-align: center;">
  		<h1>Wilkommen bei My Fitness Diary!</h1>
  		<h3>alle Ihre eingetragene Daten auch über unseren Webapplikation anschaubar und änderbar</h3>
	</div>
	<div class="container">
	<div class="formwrap center">
		<form class="form-horizontal" role="form">
 			<div class="form-group">
			<form method="post">
	    		<label class="control-label col-sm-4" for="email">Email:</label>
	    		<div class="col-sm-8">
	      			<input type="email" class="form-control" name="email" placeholder="Enter email">
	    		</div>
	  		</div>
	  		<div class="form-group">
	    		<label class="control-label col-sm-4" for="pwd">Passwort:</label>
	    		<div class="col-sm-8"> 
	      			<input type="password" class="form-control" name="pass" placeholder="Enter password">
	    		</div>
	  		</div>
			<div class="form-group">
				<div class="checkbox">
  					<label><input type="checkbox" value="">Eingeloggt bleiben</label>
				</div>
			</div>
			<div class="from-group">
				<button type="submit" class="btn btn-default" name="btn-login">Log In</button>
				<br></br>
				<a href="registration.php" type="button" class="btn btn-link">Registrieren</a>	
			</form>
			</div>
		</form>
	</div>
	</div>
</body>
</html>