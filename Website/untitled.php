<?php if(require_once './auth.php') {
  $message['notice'] = 'Für Ihren Sicherheit brauchen wir für jeden Änderung Ihren Aktuellen Password.';
} else {
  if (!empty($_POST)) {
    if (
      empty($_POST)['f']['aktpwd']) ||
      empty($_POST['f']['username'])
    );
$result = $mysqli->query($query);
if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  if (crypt($_POST['f']['password'], $row['password']) == $row['password']) {
    $mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
    if ($mysqli->connect_error) {
      $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
    }
    $query = sprintf(
      "UPDATE users (username)
      SELECT username FROM users WHERE username = '%s'
      ) LIMIT 1;",
      $mysqli->real_escape_string($_POST['f']['username'])
      );
    $mysqli->query($query);
    if ($mysqli->affected_rows == 1) {
      $message['success'] = 'Benutzername wurde geändert.';
    } else {
       $message['error'] = 'Der Benutzername ist bereits vergeben.';
    }
    $mysqli->close();
  }
}
}
} else if (!empty($_POST)) {
    if (
      empty($_POST)['f']['aktpwd']) ||
      empty($_POST['f']['password']) ||
      empty($_POST['f']['password_again']) 
    );
$result = $mysqli->query($query);
if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  if (crypt($_POST['f']['password'], $row['password']) == $row['password']) {
    $mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
    if ($mysqli->connect_error) {
      $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
    }
    $query = sprintf(
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
      "UPDATE users (password)
      SELECT username FROM users WHERE username = '%s'
      ) LIMIT 1;",
      $mysqli->real_escape_string($_POST['f']['username']),
      $mysqli->real_escape_string($_POST['f']['password']),
      $mysqli->real_escape_string($_POST['f']['email']),
      $mysqli->real_escape_string($_POST['f']['username'])
      );
    $mysqli->query($query);
    if ($mysqli->affected_rows == 1) {
      $message['success'] = 'Password wurde geändert.';
    }
    $mysqli->close();
  }
}
else {
  if (!empty($_POST)) {
    if (
      empty($_POST)['f']['aktpwd']) ||
      empty($_POST['f']['email'])
    );
$result = $mysqli->query($query);
if ($row = $result->fetch_array(MYSQLI_ASSOC)) {
  if (crypt($_POST['f']['password'], $row['password']) == $row['password']) {
    $mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
    if ($mysqli->connect_error) {
      $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
    }
    $query = sprintf(
      "UPDATE users (email)
      SELECT username FROM users WHERE username = '%s'
      ) LIMIT 1;",
      $mysqli->real_escape_string($_POST['f']['username'])
      );
    $mysqli->query($query);
    if ($mysqli->affected_rows == 1) {
      $message['success'] = 'Emailadresse wurde geändert.';
    } else {
       $message['error'] = 'Die Emailadresse ist bereits vergeben.';
    }
    $mysqli->close();
  }
}
}
?>