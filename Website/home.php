<?php require_once './auth.php'; ?>
<!DOCTYPE html>
<html lang="de_DE">
<head>
  <title>My Fitness Diary - Home</title>
  	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/stylesheet.css">
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<!-- Latest compiled JavaScript -->
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- include Google Feed API -->
	<!-- In das nachstehende Div werden die Beiträge per Javascript eingefügt -->
</head>
<body>
<?php echo $login_status; ?>
<div id="nav-container">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">My Fitness Diary</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="home.php">Home</a></li>
      <li><a href="uebersicht.php">Übersicht</a></li>
      <li><a href="statistik.php">Statistik</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
    </ul>
  </div>
</nav>
</div>
<div class="page-header" style="text-align: center;">
  		<h1>Wilkommen bei My Fitness Diary!</h1>
  		<h3>auf unsere Home-Seite können Sie alle Neuheiten aus dem Fitness-Leben miterleben.</h3>
	</div>
		<div class="container">
      <div class="feedgrabbr_widget" id="fgid_c11a88222b43b1bb7f6c0c0e2"></div>
      <script> if (typeof(fg_widgets)==="undefined") fg_widgets = new Array();fg_widgets.push("fgid_c11a88222b43b1bb7f6c0c0e2");</script>
      <script src="http://www.feedgrabbr.com/widget/fgwidget.js"></script>
		</div>
	</div>
</div>
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index.js"></script>
</body>
</html>