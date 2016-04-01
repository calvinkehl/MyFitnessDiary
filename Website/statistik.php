<?php require_once './auth.php'; ?>
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
	<script src='Chart.min.js'></script>
</head>
<body>

<div id="nav-container">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">My Fitness Diary</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
      <li><a href="uebersicht.php"><span class="glyphicon glyphicon-book"></span> Übersicht</a></li>
      <li class="active"><a href="statistik.php"><span class="glyphicon glyphicon-stats"></span> Statistik</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['username'];?></a></li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
    </ul>
  </div>
</nav>
</div>
<div class="page-header" style="text-align: center;">
  		<h1>Statistik</h1>
	</div>
		<div class="container">
	    <canvas id="myChart" width="400" height="400"></canvas>
        <!-- line chart canvas element -->
        <canvas id="buyers" width="600" height="400"></canvas>
        <!-- pie chart canvas element -->
        <canvas id="countries" width="600" height="400"></canvas>
        <!-- bar chart canvas element -->
        <canvas id="income" width="600" height="400"></canvas>
        <script>
            // line chart data
            var buyerData = {
                labels : ["Januar","Februar","März","April","Mai","Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
                datasets : [
                {
                    fillColor : "rgba(172,194,132,0.4)",
                    labelColor: "#fff",
                    strokeColor : "#ACC26D",
                    pointColor : "#fff",
                    pointStrokeColor : "#9DB86D",
                    data : [203,156,99,251,305,247]
                }
            ]
            }
            // get line chart canvas
            var buyers = (document.getElementById('buyers').getContext('2d'));
            // draw line chart
            new Chart(buyers).Line(buyerData);
            // pie chart data
            var pieData = [
                {
                    value: 20,
                    color:"#878BB6"
                },
                {
                    value : 40,
                    color : "#4ACAB4"
                },
                {
                    value : 10,
                    color : "#FF8153"
                },
                {
                    value : 30,
                    color : "#FFEA88"
                }
            ];
            // pie chart options
            var pieOptions = {
                 segmentShowStroke : false,
                 animateScale : true
            }
            // get pie chart canvas
            var countries= document.getElementById("countries").getContext("2d");
            // draw pie chart
            new Chart(countries).Pie(pieData, pieOptions);
            // bar chart data
            var barData = {
                labels : ["January","February","March","April","May","June"],
                datasets : [
                    {
                        fillColor : "#48A497",
                        strokeColor : "#48A4D1",
                        data : [456,479,324,569,702,600]
                    },
                    {
                        fillColor : "rgba(73,188,170,0.4)",
                        strokeColor : "rgba(72,174,209,0.4)",
                        data : [364,504,605,400,345,320]
                    }
                ]
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
        </script>
		</div>
	</div>

</div>
</body>
</html>