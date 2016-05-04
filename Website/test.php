<?php
class User{
	private $db;
	private $username;
	private $email;
	private $is_logged = false;
	private $msg = array();
	private $error = array();

// Update an existing user's password
	public function update($username) {
		if (!empty($_POST['email']) && $_POST['email'] !== $_POST['old_email']) {
			$this->email = $this->db->real_escape_string($_POST['email']);
			$query  = 'UPDATE users '
			. 'SET email = "' . $this->email . '" '
			. 'WHERE user = "' . $username . '"';
			if ($this->db->query($query)) $this->msg[] = 'Your email has been changed successfully.';
			else $this->error[] = 'Something went wrong. Please, try again later.';
		} elseif (!empty($_POST['email'])) $this->error[] = 'You must enter an email adress.';
		if (!empty($_POST['password']) && !empty($_POST['newpassword1']) && !empty($_POST['newpassword2'])) {
			if ($_POST['newpassword1'] == $_POST['newpassword2']) {
				$this->password = sha1($this->db->real_escape_string($_POST['password']));
				if ($this->verify_password()) {
					$this->password = sha1($this->db->real_escape_string($_POST['newpassword1']));
					$query  = 'UPDATE users '
					. 'SET password = "' . $this->password . '" '
					. 'WHERE user = "' . $username . '"';
					if ($this->db->query($query)) $this->msg[] = 'Your password has been changed successfully.';
					else $this->error[] = 'Something went wrong. Please, try again later.';
				} else $this->error[] = 'Wrong password.';
			} else $this->error[] = 'Passwords don\'t match.';
		} elseif (empty($_POST['password']) && (!empty($_POST['newpassword1']) || !empty($_POST['newpassword2']))) {
			$this->error[] = 'Old password field was empty.';
		} elseif (!empty($_POST['password']) && empty($_POST['newpassword1'])) {
			$this->error[] = 'New password field was empty.';
		} elseif (!empty($_POST['password']) && empty($_POST['newpassword2'])) {
			$this->error[] = 'You must enter the new password again.';
		}
	}
}

?>



  $message['notice'] = 'Für Ihren Sicherheit brauchen wir für jeden Änderung Ihren Aktuellen Password.';
}   if (!empty($_POST['email']) && $_POST['email'] !== $_POST['old_email']) {
      $this->email = $this->db->real_escape_string($_POST['email']);
      $query  = 'UPDATE users '
      . 'SET email = "' . $this->email . '" '
      . 'WHERE user = "' . $username . '"';
      if ($this->db->query($query)) $this->msg[] = 'Your email has been changed successfully.';
      else $this->error[] = 'Something went wrong. Please, try again later.';
    } elseif (!empty($_POST['email'])) $this->error[] = 'You must enter an email adress.';
    if (!empty($_POST['password']) && !empty($_POST['newpassword1']) && !empty($_POST['newpassword2'])) {
      if ($_POST['newpassword1'] == $_POST['newpassword2']) {
        $this->password = sha1($this->db->real_escape_string($_POST['password']));
        if ($this->verify_password()) {
          $this->password = sha1($this->db->real_escape_string($_POST['newpassword1']));
          $query  = 'UPDATE users '
          . 'SET password = "' . $this->password . '" '
          . 'WHERE user = "' . $username . '"';
          if ($this->db->query($query)) $this->msg[] = 'Your password has been changed successfully.';
          else $this->error[] = 'Something went wrong. Please, try again later.';
        } else $this->error[] = 'Wrong password.';
      } else $this->error[] = 'Passwords don\'t match.';
    } elseif (empty($_POST['password']) && (!empty($_POST['newpassword1']) || !empty($_POST['newpassword2']))) {
      $this->error[] = 'Old password field was empty.';
    } elseif (!empty($_POST['password']) && empty($_POST['newpassword1'])) {
      $this->error[] = 'New password field was empty.';
    } elseif (!empty($_POST['password']) && empty($_POST['newpassword2'])) {
      $this->error[] = 'You must enter the new password again.';
    }


else {
  if (!empty($_POST)) {
    if (
      empty($_POST['aktpwd']) ||
      empty($_POST['username'])
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
}  else if { 
  if (!empty($_POST)) {
    if (
      empty($_POST['f']['aktpwd']) ||
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
} else {
  if (!empty($_POST)) {
    if (
      empty($_POST['f']['aktpwd']) ||
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
}
?>