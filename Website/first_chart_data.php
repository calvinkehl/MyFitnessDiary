<?php require_once './auth.php'; ?>
<?php 
$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');

if ($mysqli->connect_error) {
  $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
  echo json_encode($message['error']);
} else {
  $query = sprintf(
    "SELECT * FROM data WHERE username = '%s' AND Datum BETWEEN '%s-%s-01' AND '%s-%s-31'",
    $_SESSION['user']['username'],
    $_POST['year'],
    $_POST['month'],
    $_POST['year'],
    $_POST['month']
    );
  $result = $mysqli->query($query);
  if(empty($result)) {
    $return = "empty result";
  } else {
    $resultArray = "[";
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      if($resultArray != "[") {$resultArray .=",";}
      $resultArray .= '{"datum":"'.$row['Datum'].'","uebung":"'.$row['Uebung'].'","geraet":"'.$row['Geraet'].'","gewicht":"'.$row['Gewicht'].'","wiederholungen":"'.$row['Wiederholungen'].'"}';
    }
    $resultArray .= "]";
    $return = $resultArray;
  }
}
echo json_encode($return);
?>