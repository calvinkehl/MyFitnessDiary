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
	<div class="fromwrap center">
		<form class="form-horizontal" role="form">
			<div class="form-group">
	    		<label class="control-label col-sm-4" for="email">Username:</label>
	    		<div class="col-sm-4">
	      			<input type="email" class="form-control" id="name" placeholder="Enter username">
	    		</div>
	  		</div>
	  		<div class="form-group">
	    		<label class="control-label col-sm-4" for="pwd">Passwort:</label>
	    		<div class="col-sm-4"> 
	      			<input type="password" class="form-control" id="pwd" placeholder="Enter password">
	    		</div>
	  		</div>
			<div class="form-group">
				<div class="checkbox">
  					<label><input type="checkbox" value="">Eingeloggt bleiben</label>
				</div>
			</div>
			<div class="from-group">
				<button type="submit" class="btn btn-default">Log In</button>
				<br></br>
				<a href="registration.php" type="button" class="btn btn-link">Registrieren</a>	
			</div>
		</form>
	</div>
	</div>
</body>
</html>