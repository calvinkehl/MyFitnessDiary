<?php
	$message = array();
	if (!empty($_POST)) {
		if (
			empty($_POST['f']['username']) ||
			empty($_POST['f']['password']) ||
			empty($_POST['f']['password_again']) ||
			empty($_POST['f']['email'])
		) {
			$message['error'] = 'Es wurden nicht alle Felder ausgefüllt.';
		} else if ($_POST['f']['password'] != $_POST['f']['password_again']) {
			$message['error'] = 'Die eingegebenen Passwörter stimmen nicht überein.';
		} else {
			unset($_POST['f']['password_again']);
			$salt = ''; 
			for ($i = 0; $i < 22; $i++) { 
				$salt .= substr('./ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', mt_rand(0, 63), 1); 
			}
			$_POST['f']['password'] = crypt(
				$_POST['f']['password'],
				'$2a$10$' . $salt
			);
 
			$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
			if ($mysqli->connect_error) {
				$message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
			}
			$query = sprintf(
				"INSERT INTO users (username, password, email)
				SELECT * FROM (SELECT '%s', '%s', '%s') as new_user
				WHERE NOT EXISTS (
					SELECT username FROM users WHERE username = '%s'
				) LIMIT 1;",
				$mysqli->real_escape_string($_POST['f']['username']),
				$mysqli->real_escape_string($_POST['f']['password']),
				$mysqli->real_escape_string($_POST['f']['email']),
				$mysqli->real_escape_string($_POST['f']['username'])
			);
			$mysqli->query($query);
			if ($mysqli->affected_rows == 1) {
				$message['success'] = 'Neuer Benutzer (' . htmlspecialchars($_POST['f']['username']) . ') wurde angelegt, <a href="login.php">weiter zur Anmeldung</a>.';
				header('Location: login.php');
			} else {
				$message['error'] = 'Der Benutzername ist bereits vergeben.';
			}
			$mysqli->close();
		}
	} else {
		$message['notice'] = 'Übermitteln Sie das ausgefüllte Formular um ein neues Benutzerkonto zu erstellen.';
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<title>My Fitness Diary - Registrierung</title>
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
  		<h1>Registrierung</h1>
  	</div>
  	<div class="container">
  	<div class="formwrap center">
	  	<form class="form-horizontal" role="form" action="./registration.php" method="post">
	  		<?php if (isset($message['error'])): ?>
				<fieldset class="alert alert-danger"><strong>Fehler! </strong><?php echo $message['error'] ?></fieldset>
			<?php endif;
				if (isset($message['success'])): ?>
				<fieldset class="alert alert-success"><strong>Erfolg! </strong><?php echo $message['success'] ?></fieldset>
			<?php endif;
				if (isset($message['notice'])): ?>
				<fieldset class="alert alert-info"><strong>Hinweis! </strong><?php echo $message['notice'] ?></fieldset>
			<?php endif; ?>
	  		<div class="form-group">
	    		<label class="control-label col-sm-4" for="username">Benutzername*:</label>
	    		<div class="col-sm-8">
	      			<input type="text" class="form-control" placeholder="Benutzername eingeben" name="f[username]" id="username"<?php echo isset($_POST['f']['username']) ? ' value="' . htmlspecialchars($_POST['f']['username']) . '"' : '' ?> />
	    		</div>
	  		</div>
	  		<div class="form-group">
	    		<label class="control-label col-sm-4" for="password">Passwort*:</label>
	    		<div class="col-sm-8"> 
	      			<input type="password" class="form-control" placeholder="Passwort eingeben" name="f[password]" id="password" />
	    		</div>
	  		</div>
	  		<div class="form-group">
	    		<label class="control-label col-sm-4" for="password_again">Passwort wiederholen*:</label>
	    		<div class="col-sm-8"> 
	      			<input type="password" class="form-control" placeholder="Passwort wiederholen" name="f[password_again]" id="password_again" />
	    		</div>
	  		</div>
	  		<div class="form-group">
	    		<label class="control-label col-sm-4" for="email">Email Adresse*:</label>
	    		<div class="col-sm-8"> 
	      			<input type="email" class="form-control" placeholder="Email Adresse eingeben" name="f[email]" id="email">
	    		</div>
	  		</div> 
	  		<div class="form-group"> 
	    		<div class="col-sm-offset-4 col-sm-8">
	      			<button type="submit" class="btn btn-default" name="submit"><span class="glyphicon glyphicon-send"></span> Abschicken</button>
	      			<button type="submit" class="btn btn-default" name="back" href="login.php"><span class="glyphicon glyphicon-log-in"></span> Zurück</button>
	    		</div>
	  		</div>
		</form>
	</div>
  	</form>
  	</div>
</body>
</html>