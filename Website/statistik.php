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
              <li class="active"><a href="statistik.php"><span class="glyphicon glyphicon-stats"></span> Statistik</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['username'];?></a></li>
              <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </div>
    <div id="dummy-nav"></div>
    <div id="page-header">
        <h1>Statistik</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="span2" placeholder="Von" value="" id="dpd1"></input>
                <input type="text" class="span2" placeholder="Bis" value="" id="dpd2"></input>
                <input class="btn btn-primary" id="btnClearDate" name="clear" type="submit" value="Clear Date" onClick="clearDate();" />
                <select id="uebungSelect" onchange="updateSelection();">
                </select>
            </div>
            <div class="col-md-8">
                <!-- line chart canvas element -->
                <canvas id="stats" width="600" height="400"></canvas>
                <div id="legend"></div>
            </div>
        </div>
    </div>
    <script>
      //Chart config
      Chart.defaults.global.scaleFontColor = "#fff";
      Chart.defaults.global.responsive = true;
      Chart.defaults.global.scaleBeginAtZero = true;
      //global variables
      var nowTemp = new Date();
      var year = nowTemp.getFullYear();
      var month = nowTemp.getMonth()+1;
      var day = nowTemp.getDate();  
      if(month < 10) { month = "0"+month;}
      if(day <10) { day = "0"+day;}
      //initial values for chartData
      var chartData = {
        labels : [],
        datasets : [
          {
            fillColor : "rgba(172,194,132,0.4)",
            labelColor: "#fff",
            strokeColor : "#ACC26D",
            pointColor : "#fff",
            pointStrokeColor : "#9DB86D",
            data : []
          }
        ]
      };

      $.ajax({
        url: 'ajaxPHPs/first_chart_data.php',
        type: 'POST',
        dataType: "json",
        data: {}
      }).done(function(data){
          repaintChart(JSON.parse(data));
      });
      // get line chart canvas
      var stats = (document.getElementById('stats').getContext('2d'));
      // draw line chart
      var statsLineChart = new Chart(stats).Line(chartData);

      var selectedExercise = document.getElementById('uebungSelect').value;
      $.ajax({
        url: 'ajaxPHPs/select_exercise_chart.php',
        type: 'POST',
        dataType: "json",
        data: {}
      }).done(function(data) {
        var obj = JSON.parse(data);
        var i, options = "<option>Alle</option>";
        for(i=0;i<obj.length;i++) {
          options += "<option>"+obj[i].uebung+"</option>";
        }
        document.getElementById('uebungSelect').innerHTML = options;
        updateSelection();
      });
      function updateSelection() {
        selectedExercise = document.getElementById('uebungSelect').value;
        updateChart();
      }

        //###################################################################################################################################

        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var beginDate ="";
        var endDate="";

        var begin = $('#dpd1').datepicker({
            onRender: function(date) {
                return date.valueOf() < now.valueOf() ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            var year = ev.date.getFullYear();
              var month = ev.date.getMonth()+1;
              var day = ev.date.getDate();
              if(month < 10) { month = "0"+month;}
              if(day <10) { day = "0"+day;}
              beginDate = year+"-"+month+"-"+day;
            if (beginDate > endDate) {
                var newDate = new Date(ev.date)
                newDate.setDate(newDate.getDate() + 1);
                end.setValue(newDate);
            }
            begin.hide();
            $('#dpd2')[0].focus();
        }).data('datepicker');
        var end = $('#dpd2').datepicker({
            onRender: function(date) {
                return date.valueOf() <= beginDate ? 'disabled' : '';
            }
        }).on('changeDate', function(ev) {
            end.hide();
            //Format date to match database ("yyyy-mm-dd")
            var year = ev.date.getFullYear();
            var month = ev.date.getMonth()+1;
            var day = ev.date.getDate();
            if(month < 10) { month = "0"+month;}
            if(day <10) { day = "0"+day;}
            endDate = year+"-"+month+"-"+day;
            updateChart();
        }).data('datepicker');

        function updateChart() {
          $.ajax({
              url: 'ajaxPHPs/update_chart_data.php',
              type: 'POST',
              dataType: "json",
              data: {
                  begin: beginDate,
                  end: endDate,
                  selectedExercise: selectedExercise
              }
          }).done(function(data){
              repaintChart(JSON.parse(data));
          });
        }

        function repaintChart(obj) {
          var i;
          //add the dates from entries to the label array
          var labels = new Array(obj.length);
          for(i=0;i<obj.length;i++) {
              labels[i] = obj[i].datum;
          }
          //add the weight from entries to the data array
          var data = new Array(obj.length);
          for(i=0;i<obj.length;i++) {
              data[i] = obj[i].gewicht;
          }
          chartData.labels = labels;
          chartData.datasets[0].data = data;
          //destroy old chart and build a new one
          statsLineChart.destroy();
          statsLineChart = new Chart(stats).Line(chartData);
        }

        function clearDate() {
          beginDate = "";
          endDate = "";
          document.getElementById('dpd1').value="";
          document.getElementById('dpd2').value="";
          updateChart();
        }
    </script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/index.js"></script>
<footer>
  <p>&copy; 2016 My Fitness Diary. All Rights Reserved</p>
</footer>
</body>
</html>