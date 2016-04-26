<?php require_once '../auth.php'; ?>
<?php 
$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');

if ($mysqli->connect_error) {
  $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
  echo json_encode($message['error']);
} else {
  if($_POST['split']) {
    $query = sprintf(
      "SELECT Uebung, Geraet FROM data WHERE username = '%s' AND Split = '%s' GROUP BY Uebung ORDER BY Datum",
      $_SESSION['user']['username'],
      $_POST['split']
    );
  $result = $mysqli->query($query);
  } else {
  $query = sprintf(
    "SELECT Uebung, Geraet FROM data WHERE username = '%s' GROUP BY Uebung ORDER BY Datum",
    $_SESSION['user']['username']
    );
  $result = $mysqli->query($query);
  }
  if(empty($result)) {
    $return = "empty result";
  } else {
    $resultArray = "[";
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      if($resultArray != "[") {$resultArray .=",";}
      $resultArray .= '{"uebung":"'.$row['Uebung'].'", "geraet":"'.$row['Geraet'].'"}';
    }
    $resultArray .= "]";
    $return = $resultArray;
  }
}
echo json_encode($return);
?>