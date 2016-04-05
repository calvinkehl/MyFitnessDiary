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
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="span2" value="" id="dpd1"></input>
                <input type="text" class="span2" value="" id="dpd2"></input>
                <select id="uebungSelect">

                </select>
            </div>
            <div class="col-md-8">
                <!-- line chart canvas element -->
                <canvas id="buyers" width="600" height="400"></canvas>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('uebungSelect').innerHTML = "<option>Test</option>";


        Chart.defaults.global.scaleFontColor = "#fff";
        Chart.defaults.global.responsive = true;
        var nowTemp = new Date();
        var year = nowTemp.getFullYear();
        var month = nowTemp.getMonth()+1;
        var day = nowTemp.getDate();
        if(month < 10) { month = "0"+month;}
        if(day <10) { day = "0"+day;}
        var buyerData = {
                labels : ["Januar","Februar","März","April","Mai","Juni"],
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
            };
        $.ajax({
                url: 'first_chart_data.php',
                type: 'POST',
                dataType: "json",
                data: {
                    year: year,
                    month: month,
                    day: day
                }
            }).done(function(data){
                var obj = JSON.parse(data);
                var i;
                var labels = new Array(obj.length);
                for(i=0;i<obj.length;i++) {
                    labels[i] = obj[i].datum;
                }
                var data = new Array(obj.length);
                for(i=0;i<obj.length;i++) {
                    data[i] = obj[i].gewicht;
                }
                buyerData = {
                    labels : labels,
                    datasets : [
                    {
                        fillColor : "rgba(172,194,132,0.4)",
                        labelColor: "#fff",
                        strokeColor : "#ACC26D",
                        pointColor : "#fff",
                        pointStrokeColor : "#9DB86D",
                        data : data
                    }
                    ]
                }
                buyersLineChart.destroy();
                buyersLineChart = new Chart(buyers).Line(buyerData);
            });
        // get line chart canvas
        var buyers = (document.getElementById('buyers').getContext('2d'));
        // draw line chart
        var buyersLineChart = new Chart(buyers).Line(buyerData);

        //###################################################################################################################################

        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var beginDate;
        var endDate;

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
            var year = ev.date.getFullYear();
              var month = ev.date.getMonth()+1;
              var day = ev.date.getDate();
              if(month < 10) { month = "0"+month;}
              if(day <10) { day = "0"+day;}
              endDate = year+"-"+month+"-"+day;
            $.ajax({
                url: 'update_chart_data.php',
                type: 'POST',
                dataType: "json",
                data: {
                    begin: beginDate,
                    end: endDate
                }
            }).done(function(data){
                var obj = JSON.parse(data);
                var i;
                var labels = new Array(obj.length);
                for(i=0;i<obj.length;i++) {
                    labels[i] = obj[i].datum;
                }
                var data = new Array(obj.length);
                for(i=0;i<obj.length;i++) {
                    data[i] = obj[i].gewicht;
                }
                buyerData = {
                    labels : labels,
                    datasets : [
                    {
                        fillColor : "rgba(172,194,132,0.4)",
                        labelColor: "#fff",
                        strokeColor : "#ACC26D",
                        pointColor : "#fff",
                        pointStrokeColor : "#9DB86D",
                        data : data
                    }
                    ]
                }
                buyersLineChart.destroy();
                buyersLineChart = new Chart(buyers).Line(buyerData);
            });
        }).data('datepicker');
    </script>
</body>
</html>