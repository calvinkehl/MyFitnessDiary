<?php
	require_once '../auth.php';
	$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
  	if ($mysqli->connect_error) {
		$message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
	} else {
		$i = 0;
		$query = sprintf(
			"INSERT INTO data (Uebung, Geraet, Gewicht, Wiederholungen, Datum, Username)
			VALUES ('%s', '%s', '%s', '%s', '%s', '%s');",
			$mysqli->real_escape_string($_POST['uebung']),
			$mysqli->real_escape_string($_POST['geraet']),
			$mysqli->real_escape_string($_POST['gewicht']),
			$mysqli->real_escape_string($_POST['wiederholungen']),
			$mysqli->real_escape_string($_POST['date']),
			$mysqli->real_escape_string($_SESSION['user']['username'])
		);
		$mysqli->query($query);
	}
?>
