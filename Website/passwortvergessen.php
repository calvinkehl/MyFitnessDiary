<?php 
$pdo = new PDO('mysql:host=localhost;dbname=MyFitnessDiary', 'root', '');
 
function random_string() {
	if(function_exists('openssl_random_pseudo_bytes')) {
		$bytes = openssl_random_pseudo_bytes(16);
		$str = bin2hex($bytes); 
	} else if(function_exists('mcrypt_create_iv')) {
		$bytes = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);
		$str = bin2hex($bytes); 
	} else {
		//Bitte euer_geheim_string durch einen zufälligen String mit >12 Zeichen austauschen
		$str = md5(uniqid('euer_geheimer_string', true));
	}	
	return $str;
}
 
 
$showForm = true;
 
if(isset($_GET['send']) ) {
	if(!isset($_POST['email']) || empty($_POST['email'])) {
		$error = "<b>Bitte eine E-Mail-Adresse eintragen</b>";
	} else {
		$statement = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$result = $statement->execute(array('email' => $_POST['email']));
		$user = $statement->fetch();		
 
		if($user === false) {
			$error = "<b>Kein Benutzer gefunden</b>";
		} else {
			//Überprüfe, ob der User schon einen Passwortcode hat oder ob dieser abgelaufen ist 
			$passwortcode = random_string();
			$statement = $pdo->prepare("UPDATE users SET passwortcode = :passwortcode, passwortcode_time = NOW() WHERE id = :userid");
			$result = $statement->execute(array('passwortcode' => sha1($passwortcode), 'userid' => $user['id']));
	
			$empfaenger = $user['email'];
			$betreff = "Neues Passwort für deinen Account auf MyFitnessDiary"; //Ersetzt hier den Domain-Namen
			$from = "From: Robert-Kristian Korsos <kristian_korsos@yahoo.de>"; //Ersetzt hier euren Name und E-Mail-Adresse
			$url_passwortcode = 'http://localhost/MyFitnessDiary/passwortzuruecksetzen.php?userid='.$user['id'].'&code='.$passwortcode; //Setzt hier eure richtige Domain ein
			$text = 'Hallo,
für deinen Account auf MyFitnessDiary wurde nach einem neuen Passwort gefragt. Um ein neues Passwort zu vergeben, rufe innerhalb der nächsten 24 Stunden die folgende Website auf:
'.$url_passwortcode.'
 
Sollte dir dein Passwort wieder eingefallen sein oder hast du dies nicht angefordert, so bitte ignoriere diese E-Mail.
 
Viele Grüße,
dein MyFitnessDiary-Team';
			 
			mail($empfaenger, $betreff, $text, $from);
 
			echo "Ein Link um dein Passwort zurückzusetzen wurde an deine E-Mail-Adresse gesendet.";	
			$showForm = false;
		}
	}
}
 
if($showForm):
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Fitness Diary - Passwort vergessen</title>
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
  		<h3>Passwort vergessen? Kein Problem!</h3>
	</div>
	<div class="container">
	<div class="formwrap center">
		<form class="form-horizontal" role="form" action="?send=1" method="post">
 			<div class="form-group">
	    		<label class="control-label col-sm-4" for="email">Email:</label>
	    		<div class="col-sm-8">
	      			<input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlentities($_POST['email']) : ''; ?>" placeholder="Email eingeben">    	
	    		</div>
	    	</div>
	    	<div class="form-group">
	    		<div>
	    		<label class="control-label col-sm-4" for="email">Wiederherstellung:</label>
	    		<div class="col-sm-8">  	
	    			<input type="submit" class="form-control" value ="Neues Passwort" id="passwort">
	    		</div>
	  		</div>
		</form>
	</div>
	</div>
</body>
</html>
<?php
endif; //Endif von if($showForm)
?>