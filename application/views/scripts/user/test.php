 <?php 

$parm = $_GET['prest'];
$conn = mysqli_connect('localhost', 'lpweb', 'lpweb', 'Ospedale');
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$query = "select id, tipoprestazione from Prestazioni where idreparto='" . $parm . "'";
$ris = mysqli_query($conn, $query);
foreach ($ris as $pre) {
    $data[$pre['id']] = $pre['tipoprestazione'];
};
header('Content-Type: application/json');
echo json_encode($data);
mysqli_free_result($ris);
mysqli_close($conn);

