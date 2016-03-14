<!DOCTYPE html>
<html lang="de">
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
<div id="weblica-feed"></div>

<script type="text/javascript">

$(document).ready(function() { 
    // add a feed manually 
    $('#weblica-feed').gFeed({  
        url: 'http://www.theverge.com/rss/full.xml',
        title: 'Der weblica Web-Feed eingebunden',
        max: 3
    });     
}); 

</script>

</head>
<body>

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
<div class="page-header" style="text-align: center;">
  		<h1>Wilkommen bei My Fitness Diary!</h1>
  		<h3>auf unsere Home-Seite können Sie alle Neuheiten aus dem Fitness-Leben miterleben.</h3>
	</div>
		<div class="container">
			<div class="fromwrap center">
				<form class="form-horizontal" role="form">
			<iframe width="999" height="400" src="http://www.rss-anzeigen.com/feed.php?showtype=1&url=http://www.theverge.com/rss/full.xml&textfont=2&fontsize=10&fontc=000000&linkc=0000FF&tabwidth=999&tabborder=888888&tabbg=F8F8F8&newscount=5&newsshow=1&maxchars=0&target=1&ifbg=FFFFFF" frameborder=0></iframe>
		
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>