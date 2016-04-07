<?php
if (isset($_SESSION['login'])) {
	header('Location: home.php');
} else {
	if (!empty($_POST)) {
		if (
			empty($_POST['f']['username']) ||
			empty($_POST['f']['password'])
		) {
			$message['error'] = 'Es wurden nicht alle Felder ausgefüllt.';
		} else {
			$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
			if ($mysqli->connect_error) {
				$message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
			} else {
				$query = sprintf(
					"SELECT username, password FROM users WHERE username = '%s'",
					$mysqli->real_escape_string($_POST['f']['username'])
				);
				$result = $mysqli->query($query);
				if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
					if (crypt($_POST['f']['password'], $row['password']) == $row['password']) {
						session_start();
 
						$_SESSION = array(
							'login' => true,
							'user'  => array(
								'username'  => $row['username']
							)
						);
						$message['success'] = 'Anmeldung erfolgreich, <a href="home.php">weiter zum Inhalt.';
						header('Location: home.php');
					} else {
						$message['error'] = 'Das Kennwort ist nicht korrekt.';
					}
				} else {
					$message['error'] = 'Der Benutzer wurde nicht gefunden.';
				}
				$mysqli->close();
			}
		}
	} else {
		$message['notice'] = 'Geben Sie Ihre Zugangsdaten ein um sich anzumelden.<br />' .
			'Wenn Sie noch kein Konto haben, gehen Sie <a href="registration.php">zur Registrierung</a>.';
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

	<div id="page-header">
  		<h1>Wilkommen bei My Fitness Diary!</h1>
  		<h3>alle Ihre eingetragene Daten auch über unseren Webapplikation anschaubar und änderbar</h3>
	</div>
	<div class="container">
	<div class="formwrap center">
		<form class="form-horizontal" role="form" action="./login.php" method="post">
 			<div class="form-group">
			<?php if (isset($message['error'])): ?>
				<fieldset class="alert alert-danger"><strong>Fehler! </strong><?php echo $message['error'] ?></fieldset>
			<?php endif;
				 if (isset($message['success'])): ?>
			<fieldset class="alert alert-success"><strong>Erfolg! </strong><?php echo $message['success'] ?></fieldset>
			<?php endif;
				 if (isset($message['notice'])): ?>
			<fieldset class="alert alert-info"><strong>Hinweis! </strong><?php echo $message['notice'] ?></fieldset>
			<?php endif; ?>
	    		<label class="control-label col-sm-4" for="username">Benutzername:</label>
	    		<div class="col-sm-8">
	      			<input type="user" class="form-control" name="f[username]" id="username" placeholder="Enter username">    	
	    	</div>
	  		</div>
	  		<div class="form-group">
	    		<label class="control-label col-sm-4" for="pwd">Passwort:</label>
	    		<div class="col-sm-8"> 
	      			<input type="password" class="form-control" name="f[password]" id="passwort" placeholder="Passwort eingeben">
	    		</div>
	  		</div>
			<div class="form-group">
				<div class="checkbox">
  					<label><input type="checkbox" value="">Eingeloggt bleiben</label>
				</div>
			</div>
			<div class="from-group">
				<button type="submit" class="btn btn-default" name="submit">Anmelden</button>
				<br></br>
				<a href="registration.php" type="button" class="btn btn-link">Registrieren</a>
				<br></br>
				<a href="passwortvergessen.php" type="button" class="btn btn-link">Passwort vergessen</a>
			</div>
		</form>
	</div>
	</div>
</body>
</html>