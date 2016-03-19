<?php
$pdo = new PDO('mysql:host=localhost;dbname=MyFitnessDiary', 'root', '');
 
if(!isset($_GET['userid']) || !isset($_GET['code'])) {
	die("Leider wurde beim Aufruf dieser Website kein Code zum Zurücksetzen deines Passworts übermittelt");
}
 
$userid = $_GET['userid'];
$code = $_GET['code'];
 
//Abfrage des Nutzers
$statement = $pdo->prepare("SELECT * FROM users WHERE id = :userid");
$result = $statement->execute(array('userid' => $userid));
$user = $statement->fetch();
 
//Überprüfe dass ein Nutzer gefunden wurde und dieser auch ein Passwortcode hat
if($user === null || $user['passwortcode'] === null) {
	die("Es wurde kein passender Benutzer gefunden");
}
 
if($user['passwortcode_time'] === null || strtotime($user['passwortcode_time']) < (time()-24*3600) ) {
	die("Dein Code ist leider abgelaufen");
}
 
 
//Überprüfe den Passwortcode
//if(sha1($code) != $user['passwortcode']) {
//	die("Der übergebene Code war ungültig. Stell sicher, dass du den genauen Link in der URL aufgerufen hast.");
//}
 
//Der Code war korrekt, der Nutzer darf ein neues Passwort eingeben
 
if(isset($_GET['send'])) {
	$passwort = $_POST['passwort'];
	$passwort2 = $_POST['passwort2'];
	
	if($passwort != $passwort2) {
		echo "Bitte identische Passwörter eingeben";
	} else { //Speichere neues Passwort und lösche den Code
		$passworthash = password_hash($passwort, PASSWORD_DEFAULT);
		$statement = $pdo->prepare("UPDATE users SET password = :passworthash, passwortcode = NULL, passwortcode_time = NULL WHERE id = :userid");
		$result = $statement->execute(array('passworthash' => $passworthash, 'userid'=> $userid ));
		
		if($result) {
			die("Dein Passwort wurde erfolgreich geändert");
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Fitness Diary - Neues Passwort vergeben</title>
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
  		<h3>Hier bekommen Sie Ihren neuen Passwort!</h3>
	</div>
	<div class="container">
	<div class="formwrap center">
		<form class="form-horizontal" role="form" action="?send=1&amp;userid=<?php echo htmlentities($userid); ?>&amp;code=<?php echo htmlentities($code); ?>" method="post">
 			<div class="form-group">
	    	<label class="control-label col-sm-4" for="password">Bitte gib ein neues Passwort ein:</label>
	    		<div class="col-sm-8">
	      			<input type="password" class="form-control" name="passwort" placeholder="Passwort eingeben">    	
	    		</div>
	    	</div>
	    	<div class="form-group">
	    	<label class="control-label col-sm-4" for="email">Passwort erneut eingeben:</label>
	    		<div class="col-sm-8">  	
	    			<input type="password" class="form-control" name="passwort2" placeholder="Passwort wiederholen">  
	    		</div>
	  		</div>
	  		<div class="form-group">
	    		<div class="col-sm-8">  	
	    			<input type="submit" class="form-control" class="btn btn-default" name="submit"></button>
	    		</div>
	    	</div> 
		</form>
	</div>
	</div>
</body>
</html>