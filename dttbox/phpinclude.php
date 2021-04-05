<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'digitalbox';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
$CH4 = '';
$id = '';
//query to get data from the table
$sql = "SELECT CH4,id
  from dbox order by id desc limit 5 ";
$result = mysqli_query($mysqli, $sql);
//loop through the returned data
while ($row = mysqli_fetch_array($result)) {
    $id = $id . '"' . $row['id'] . '",';
    $CH4 = $CH4 . '"' . $row['CH4'] . '",';
}
$id = trim($id, ",");
$CH4 = trim($CH4, ",");
?>

