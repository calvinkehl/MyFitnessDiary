<!DOCTYPE html>
<html lang="de_DE">
<head>
  <title>My Fitness Diary - Übersicht</title>
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
</head>
<body>

<div id="nav-container">
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand">My Fitness Diary</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="home.php">Home</a></li>
      <li class="active"><a href="uebersicht.php">Übersicht</a></li>
      <li><a href="statistik.php">Statistik</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="login.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
    </ul>
  </div>
</nav>
</div>
<div class="page-header" style="text-align: center;">
  		<h1>Übersicht Ihrer Trainings-Eintragen</h1>
	</div>
		<div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="table" id="overview">
            <table class="table">
              <tr>
                <th>übung</th>
                <th>Gerät</th>
                <th>Gewicht</th>
                <th>Wiederholungen</th>
              </tr>
              <tr>
              </tr>
            </table>
          </div>
        </div>
        <div class="col-md-4">
          <div id="datepicker"></div>
        </div>
		  </div>
    </div>
	</div>
</div>
<script>
    var date_input=$('#datepicker'); //our date input has the name "date" (input[name="date"])
    var container=$('.container').length>0 ? $('.container').parent() : "body";
    var options={
        format: 'mm/dd/yyyy',
        todayHighlight: true,
        autoclose: true,
    };
    date_input.datepicker(options); //initiali110/26/2015 8:20:59 PM ze plugin
</script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>
</body>
</html>