<?php require_once './auth.php'; ?>
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
          <li><a href="home.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
          <li class="active"><a href="uebersicht.php"><span class="glyphicon glyphicon-book"></span> Übersicht</a></li>
          <li><a href="statistik.php"><span class="glyphicon glyphicon-stats"></span> Statistik</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href=""><span class="glyphicon glyphicon-user"></span> <?php echo $_SESSION['user']['username'];?></a></li>
          <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
        </ul>
      </div>
    </nav>
  </div>
    <div id="dummy-nav"></div>
  <div id="page-header">
    <h1>Übersicht Ihrer Trainings-Eintragen</h1>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="table" id="overview">
          <input class="btn btn-primary" name="edit" type="submit" value="Edit" onClick="editFunc();" />
          <table id="table" class="table">
            <tr>
              <th>Übung</th>
              <th>Gerät</th>
              <th>Gewicht</th>
              <th>Wiederholungen</th>
              <input id="date" type="hidden" />
            </tr>
            <tr>
              <td>Kein Datum ausgewählt...</td>
            </tr>
          </table>
        </div>
      </div>
      <div class="col-md-4">
        <div id="datepicker" data-date=""></div>
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
    date_input.datepicker().on('changeDate', function(ev) {
      var element = document.getElementById('date');
      var year = ev.date.getFullYear();
      var month = ev.date.getMonth()+1;
      var day = ev.date.getDate();
      if(month < 10) { month = "0"+month;}
      if(day <10) { day = "0"+day;}
      var date = year+"-"+month+"-"+day;
      element.value = date;

      $.ajax({
        url: 'ajaxPHPs/date_picked.php',
        type: 'POST',
        dataType: "json",
        data: {
          date: date
        }
      }).done(function(data){
        var obj = JSON.parse(data);
        var i;
        var out = "<tr>" +
                    "<th>Übung</th>" +
                    "<th>Gerät</th>" +
                    "<th>Gewicht</th>" +
                    "<th>Wiederholungen</th>" +
                    "<input id=\"date\" type=\"hidden\" value=\""+date+"\" />" +
                  "</tr>";
        for(i=0;i<obj.length;i++) {
          out +=  "<tr>" +
                    "<td>" + obj[i].uebung + "</td>" +
                    "<td>" + obj[i].geraet + "</td>" +
                    "<td>" + obj[i].gewicht + "</td>" +
                    "<td>" + obj[i].wiederholungen + "</td>" +
                  "</tr>";
        }
        document.getElementById("table").innerHTML = out;
      });
    });
  </script>
  <script>
    var i;
    function editFunc() {
      var element = document.getElementById('date');
      var date = element.value;

      $.ajax({
        url: 'ajaxPHPs/date_picked.php',
        type: 'POST',
        dataType: "json",
        data: {
          date: date
        }
      }).done(function(data){
        var obj = JSON.parse(data);
        var out = "<tr>" +
                    "<th>Übung</th>" +
                    "<th>Gerät</th>" +
                    "<th>Gewicht</th>" +
                    "<th>Wiederholungen</th>" +
                    "<input id=\"date\" type=\"hidden\" value=\""+date+"\" />" +
                  "</tr>";
        for(i=0;i<obj.length;i++) {
          out +=  "<tr>" +
                    "<td><input name=\"uebung"+i+"\" type=\"text\" value="+obj[i].uebung+"></input></td>" +
                    "<td><input name=\"geraet"+i+"\" type=\"text\" value="+obj[i].geraet+"></input></td>" +
                    "<td><input name=\"gewicht"+i+"\" type=\"text\" value="+obj[i].gewicht+"></input></td>" +
                    "<td><input name=\"wiederholungen"+i+"\" type=\"text\" value="+obj[i].wiederholungen+"></input></td>" +
                  "</tr>";
        }
          out +=  "<tr>" +
                    "<td><input name=\"uebung"+i+"\" type=\"text\" /></td>" +
                    "<td><input name=\"geraet"+i+"\" type=\"text\" /></td>" +
                    "<td><input name=\"gewicht"+i+"\" type=\"text\" /></td>" +
                    "<td><input name=\"wiederholungen"+i+"\" type=\"text\" /></td>" +
                  "</tr>" +
                  "<tr id=\"insert\">" +
                    "<td><input class=\"btn btn-primary\" value=\"+\" name=\"add\" type=\"submit\" onClick=\"addFunc();\" /></td>" +
                    "<td></td>" +
                    "<td><input class=\"btn btn-primary\" value=\"Abbrechen\" name=\"discard\" type=\"submit\" onClick=\"discardFunc();\" /></td>" +
                    "<td><input class=\"btn btn-primary\" value=\"Speichern\" name=\"save\" type=\"submit\" onClick=\"saveFunc();\" /></td>" +
                  "</tr>";
        document.getElementById("table").innerHTML = out;
      });
    }
    function addFunc() {
      var insert = document.getElementById('insert');
      i++;
      var new_row = insert.parentNode.insertRow( insert.rowIndex);
      new_row.insertCell(0).innerHTML = "<input name=\"uebung"+i+"\" type=\"text\" />";
      new_row.insertCell(1).innerHTML = "<input name=\"geraet"+i+"\" type=\"text\" />";
      new_row.insertCell(2).innerHTML = "<input name=\"gewicht"+i+"\" type=\"text\" />";
      new_row.insertCell(3).innerHTML = "<input name=\"wiederholungen"+i+"\" type=\"text\" />";
    }
    function saveFunc() {
      var element = document.getElementById('date');
      var uebung;
      var geraet;
      var gewicht;
      var wiederholungen;
      var date = element.value;
      var a;
      $.ajax({
        url: 'ajaxPHPs/del_current.php',
        type: 'POST',
        dataType: 'json',
        data: {
          date: date
        }
      });
      for(a=0;a<=i;a++) {
        uebung = document.getElementsByName('uebung'+a)[0];
        geraet = document.getElementsByName('geraet'+a)[0];
        gewicht = document.getElementsByName('gewicht'+a)[0];
        wiederholungen = document.getElementsByName('wiederholungen'+a)[0];
        if(uebung.value == "" ||
            geraet.value == "" ||
            gewicht.value == "" ||
            wiederholungen.value == "") {
          /* do nothing */
        } else {
          $.ajax({
            url: 'ajaxPHPs/save.php',
            type: 'POST',
            dataType: 'json',
            data: {
              uebung: uebung.value,
              geraet: geraet.value,
              gewicht: gewicht.value,
              wiederholungen: wiederholungen.value,
              date: date
            }
          });
        }
      }

    }
  </script>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>
</body>
</html>