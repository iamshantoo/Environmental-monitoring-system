<!DOCTYPE html>
<html>
	<head>
		<meta chartset="utf-8">
		<title>Speed Chart</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<style type="text/css">
			.container {
	          width: 50%;
	          height: 30%;
      		}
		</style>
	    <script src="js/Chart.js"></script>
		<script src="js/Gauge.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="row" align="center">
				<canvas id="canvas" width="100" height="100"></canvas>
			</div>
		</div>
	</body>
</html>

<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'digitalbox';
$mysqli = new mysqli($host, $user, $pass, $db) or die($mysqli->error);
$CO2 = '';
//query to get data from the table
$sql = "SELECT CO2
  from dbox order by id desc limit 1 ";
$result = mysqli_query($mysqli, $sql);

//loop through the returned data
while ($row = mysqli_fetch_array($result))
{
    $CO2 = $CO2 . '"' . $row['CO2'] . '",';
}
$CO2 = trim($CO2, ",");

?>

<script type="text/javascript">
	var ctx = document.getElementById("canvas").getContext("2d");
	new Chart(ctx, {
		type: "tsgauge",
		data: {
			datasets: [{
				backgroundColor: [ '#008000','#ffff00', '#ff0000' ],
				borderWidth: 0,
				gaugeData: {
					value: <?php echo $CO2; ?>,
					 label: "Speed",
					valueColor: "#ff7143"
				},
				gaugeLimits: [0, 1000, 2000, 3000]
			}]
		},
		options: {
			events: [],
			showMarkers: true
			
		}
	});
</script>