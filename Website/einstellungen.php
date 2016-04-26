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
          <button class="navbar-toggle" data-toggle="collapse" data-target= ".navHeaderCollapse">
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
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="einstellungen.php">Settings</a></li>
                <li><a href="">Profil</a></li>
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
    <h1>User Konfig</h1>
  </div>
  <div class="container">
    <div class="splitContainer center">
      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" onClick="loadSplit('1')" href="#split1">Split 1</a></li>
        <li><a data-toggle="tab" onClick="loadSplit('2')" href="#split2">Split 2</a></li>
      </ul>

      <div class="tab-content">
        <div id="split1" class="tab-pane fade in active">

        </div>
        <div id="split2" class="tab-pane fade">
          
        </div>
      </div>
    </div>
  </div>
  <script>
    $.ajax({
      url: 'ajaxPHPs/select_exercise_chart.php',
      type: 'POST',
      dataType: "json",
      data: {
        split: 1
      }
    }).done(function(data){
      var obj = JSON.parse(data);
      var out = "<div class=\"table-responsive\">" +
                  "<table id=\"table\" class=\"table\">" +
                    "<tr>" +
                      "<th>Übung</th>" +
                      "<th>Gerät</th>" +
                    "</tr>";
      for(i=0;i<obj.length;i++) {
            out +=  "<tr>" +
                      "<td><input name=\"uebung"+i+"\" type=\"text\" value="+obj[i].uebung+"></input></td>" +
                      "<td><input name=\"geraet"+i+"\" type=\"text\" value="+obj[i].geraet+"></input></td>" +
                    "</tr>";
      }
            out +=  "<tr>" +
                      "<td><input name=\"uebung"+i+"\" type=\"text\" /></td>" +
                      "<td><input name=\"geraet"+i+"\" type=\"text\" /></td>" +
                    "</tr>" +
                    "<tr id=\"insert\">" +
                      "<td><input class=\"btn btn-primary\" value=\"+\" name=\"add\" type=\"submit\" onClick=\"addFunc();\" /></td>" +
                      "<td><input class=\"btn btn-primary\" value=\"Speichern\" name=\"save\" type=\"submit\" onClick=\"saveFunc();\" /></td>" +
                    "</tr>" +
                  "</table>" +
                "</div>";
      document.getElementById("split1").innerHTML = out;
    });

    function loadSplit(selected) {
    $.ajax({
      url: 'ajaxPHPs/select_exercise_chart.php',
      type: 'POST',
      dataType: "json",
      data: {
        split: selected
      }
    }).done(function(data){
      var obj = JSON.parse(data);
      var out = "<div class=\"table-responsive\">" +
                  "<table id=\"table\" class=\"table\">" +
                    "<tr>" +
                      "<th>Übung</th>" +
                      "<th>Gerät</th>" +
                    "</tr>";
      for(i=0;i<obj.length;i++) {
            out +=  "<tr>" +
                      "<td><input name=\"uebung"+i+"\" type=\"text\" value="+obj[i].uebung+"></input></td>" +
                      "<td><input name=\"geraet"+i+"\" type=\"text\" value="+obj[i].geraet+"></input></td>" +
                    "</tr>";
      }
            out +=  "<tr>" +
                      "<td><input name=\"uebung"+i+"\" type=\"text\" /></td>" +
                      "<td><input name=\"geraet"+i+"\" type=\"text\" /></td>" +
                    "</tr>" +
                    "<tr id=\"insert\">" +
                      "<td><input class=\"btn btn-primary\" value=\"+\" name=\"add\" type=\"submit\" onClick=\"addFunc();\" /></td>" +
                      "<td><input class=\"btn btn-primary\" value=\"Speichern\" name=\"save\" type=\"submit\" onClick=\"saveFunc();\" /></td>" +
                    "</tr>" +
                  "</table>" +
                "</div>";
      document.getElementById("split"+selected).innerHTML = out;
    });
    }

    function addFunc() {
      var insert = document.getElementById('insert');
      i++;
      var new_row = insert.parentNode.insertRow( insert.rowIndex);
      new_row.insertCell(0).innerHTML = "<input name=\"uebung"+i+"\" type=\"text\" />";
      new_row.insertCell(1).innerHTML = "<input name=\"geraet"+i+"\" type=\"text\" />";
    }


    
  </script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="js/index.js"></script>
  <footer>
    <p>&copy; 2016 My Fitness Diary. All Rights Reserved</p>
  </footer>
</body>
</html>