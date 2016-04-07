<?php require_once '../auth.php'; ?>
<?php 
$mysqli = @new mysqli('localhost', 'root', '', 'MyFitnessDiary');

if ($mysqli->connect_error) {
  $message['error'] = 'Datenbankverbindung fehlgeschlagen: ' . $mysqli->connect_error;
  echo json_encode($message['error']);
} else {
  $query = sprintf(
    "SELECT Uebung FROM data WHERE username = '%s' GROUP BY Uebung",
    $_SESSION['user']['username']
    );
  $result = $mysqli->query($query);
  if(empty($result)) {
    $return = "empty result";
  } else {
    $resultArray = "[";
    while($row = $result->fetch_array(MYSQLI_ASSOC)) {
      if($resultArray != "[") {$resultArray .=",";}
      $resultArray .= '{"uebung":"'.$row['Uebung'].'"}';
    }
    $resultArray .= "]";
    $return = $resultArray;
  }
}
echo json_encode($return);
?>