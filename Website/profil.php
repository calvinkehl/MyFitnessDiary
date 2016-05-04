<?php if(require_once './auth.php') {
  $message['notice'] = 'Hier können Sie Ihren Daten bequem ändern lassen';
} if (!empty($_POST)) {
    if (empty($_POST['f']['username'])) {
    } else {
      $mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
      if ($mysqli->connect_error) {
        $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
      }
      $query = sprintf(
        "UPDATE users SET username = '%s' WHERE username ='".$_SESSION['user']['username']."'",
        $mysqli->real_escape_string($_POST['f']['username'])
      );
      $mysqli->query($query);
      if ($mysqli->affected_rows == 1) {
        $message['success'] = 'Benutzername wurde geändert';
      } else {
        $message['error'] = 'Der Benutzername ist bereits vergeben.';
      }
      $mysqli->close();
    }
  } 
 if (!empty($_POST)) {
    if (empty($_POST['f']['email'])) {
    } else {
      $mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');
      if ($mysqli->connect_error) {
        $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
      }
      $query = sprintf(
        "UPDATE users SET email = '%s' WHERE username ='".$_SESSION['user']['username']."'",
        $mysqli->real_escape_string($_POST['f']['email'])
      );
      $mysqli->query($query);
      if ($mysqli->affected_rows == 1) {
        $message['success'] = 'Email wurde geändert';
      } else {
        $message['error'] = 'Die Emailadresse ist bereits vergeben.';
      }
      $mysqli->close();
    }
  }
  if (!empty($_POST)) {
    if (
      empty($_POST['f']['password']) ||
      empty($_POST['f']['password_again'])
    ) {
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
        "UPDATE users SET password = '%s' WHERE username ='".$_SESSION['user']['username']."'",
        $mysqli->real_escape_string($_POST['f']['password'])
      );
      $mysqli->query($query);
      if ($mysqli->affected_rows == 1) {
        $message['success'] = 'Das Password wurde geändert';
      } 
      $mysqli->close();
    }
  }     
?>
<!DOCTYPE html>
<html lang="de_DE">
<head>
  <title>My Fitness Diary - Statistik</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/stylesheet.css">
  <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  <!--Chartjs plugin-->
  <script src='js/Chart.min.js'></script>
</head>
<body>
  <div id="nav-container">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand">My Fitness Diary</a>
          <button class="navbar-toggle" data-toggle="collapse" 
          data-target= ".navHeaderCollapse">
          <span class = "icon-bar"></span>
          <span class = "icon-bar"></span>
          <span class = "icon-bar"></span>
        </button>
      </div>
      <div class = "collapse navbar-collapse navHeaderCollapse">
        <ul class="nav navbar-nav">
          <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li><a href="uebersicht.php"><span class="glyphicon glyphicon-book"></span> Übersicht</a></li>
          <li><a href="statistik.php"><span class="glyphicon glyphicon-stats"></span> Statistik</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['username'];?>
              <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class="active"><a href="profil.php">Profil</a></li>
              </ul>
            </li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <div id="dummy-nav"></div>
  <div id="page-header">
    <h1>Benutzer Profil</h1>
  </div>
  <div class="container">
    <div class="splitContainer center">
      <div class="btn-group">
        <form class="form-horizontal" role="form" method="post">
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
        <div class="form-group">
            <label for="username">Benutzername ändern:</label>
            <input type="text" class="form-control" placeholder="Benutzername eingeben" name="f[username]" id="username"<?php echo isset($_POST['f']['username']) ? ' value="' . htmlspecialchars($_POST['f']['username']) . '"' : '' ?> /></input>
        </div>
          <div class="form-group">
            <label for="email">Email Adresse ändern:</label>
            <input type="email" class="form-control" placeholder="Email Adresse eingeben" name="f[email]" id="email">
          </div>
          <div class="form-group">
            <label for="password">Neues Passwort:</label>
            <input type="password" class="form-control" placeholder="Neues Passwort eingeben" name="f[password]" id="password" />
          </div>
          <div class="form-group">
            <label  for="password_again">Neues Passwort wiederholen:</label>
            <input type="password" class="form-control" placeholder="Passwort wiederholen" name="f[password_again]" id="password_again" />
          </div>
          <button type="submit" class="btn btn-default" name="submit"><span class="glyphicon glyphicon-send"></span> Abschicken</button>
        </form>
      </div>
    </div>
  </div>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="js/index.js"></script>
  <footer>
    <p>&copy; 2016 My Fitness Diary. All Rights Reserved</p>
  </footer>
</body>
</html>