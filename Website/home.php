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
			<div class="fromwrap center">
				<form class="form-horizontal" role="form">
			<!--<iframe width="999" height="400" src="http://www.rss-anzeigen.com/feed.php?showtype=1&url=http://www.theverge.com/rss/full.xml&textfont=2&fontsize=10&fontc=000000&linkc=0000FF&tabwidth=999&tabborder=888888&tabbg=F8F8F8&newscount=5&newsshow=1&maxchars=0&target=1&ifbg=FFFFFF" frameborder=0></iframe>-->
			<!--<?php
function rss2html($url,$anz) {
   $n=1;
   $output = '<ul>';
   if ($rss = @simplexml_load_file($url)) {
      foreach($rss->channel->item as $item) {
        $output .= '<li class="item_link">';
        $output .= '<a href = "'.$item->link.'">'.$item->title.'</a> ';
        $output .= '<span class="it_date"> - ';
        $output .= date("d.m.Y",strtotime($item->pubDate)).'</span>';
        $output .= '<br />'.$item->description;
        //$output .= "<a href=\"{$item->link}\"> ...</a>";
        $output .= '</li>';

        if($n>=$anz){break;}
        $n++;
      }
      return utf8_decode($output).'</ul>';
   } else {return "<p>Fehler beim Einlesen der Datei $url</p>";}
}
?>
<?php echo rss2html("http://www.fitforfun.de/fff/XML/rss_fffnews_sport.xml",4); ?> -->

<div class="feedgrabbr_widget" id="fgid_c11a88222b43b1bb7f6c0c0e2"></div>
<script> if (typeof(fg_widgets)==="undefined") fg_widgets = new Array();fg_widgets.push("fgid_c11a88222b43b1bb7f6c0c0e2");</script>
<script src="http://www.feedgrabbr.com/widget/fgwidget.js"></script>
		
				</form>
			</div>
      <div id="placeholder">
      </div>
		</div>
	</div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

</body>
</html>