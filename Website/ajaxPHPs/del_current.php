<?php
	require_once '../auth.php';
	$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
  	if ($mysqli->connect_error) {
		$message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
	} else {
		$i = 0;
		$query = sprintf("DELETE FROM data WHERE Username = '".$_SESSION['user']['username']."' AND Datum = '".$_POST['date']."';");
		$mysqli->query($query);
	}
?>