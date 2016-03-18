<?php
	require_once './auth.php';
	$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
  	if ($mysqli->connect_error) {
		$message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
	} else {
		$i = 0;
		$query = sprintf("DELETE FROM data WHERE Username = '".$_SESSION['user']['username']."';");
		$mysqli->query($query);
		while ($i < $_SESSION['i']) {
			$query = sprintf(
				"INSERT INTO data (Uebung, Geraet, Gewicht, Wiederholungen, Username)
				VALUES ('%s', '%s', '%s', '%s', '%s');",
				$mysqli->real_escape_string($_GET['uebung'.$i]),
				$mysqli->real_escape_string($_GET['geraet'.$i]),
				$mysqli->real_escape_string($_GET['gewicht'.$i]),
				$mysqli->real_escape_string($_GET['wiederholungen'.$i]),
				$mysqli->real_escape_string($_SESSION['user']['username'])
			);
			$mysqli->query($query);
			$i++;
		}
	}
?>
<a href="uebersicht.php">zurück</a>