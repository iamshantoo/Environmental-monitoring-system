<?php
$connect = mysqli_connect("localhost", "root", "", "digitalbox");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM dbox 
	WHERE DID LIKE '%".$search."%'
	OR TMP LIKE '%".$search."%' 
	OR HUM LIKE '%".$search."%' 
	OR CO2 LIKE '%".$search."%' 
	OR VOC LIKE '%".$search."%'
	OR CH4 LIKE '%".$search."%' 
	OR date LIKE '%".$search."%'
	";
}
else
{
	$query = "
	SELECT * FROM dbox ORDER BY id";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
	$output .= '<div class="table-responsive">
					<table class="table table bordered" style="background-color:black; color: white;">
						<tr>
							<th>Device ID</th>
							<th>Temperature</th>
							<th>Humidity</th>
							<th>Carbon Dioxide</th>
							<th>VOC</th>
							<th>Methane</th>
							<th>Date</th>
						</tr>';
	while($row = mysqli_fetch_array($result))
	{
		$output .= '
			<tr>
				<td>'.$row["DID"].'</td>
				<td>'.$row["TMP"].'</td>
				<td>'.$row["HUM"].'</td>
				<td>'.$row["CO2"].'</td>
				<td>'.$row["VOC"].'</td>
				<td>'.$row["CH4"].'</td>
				<td>'.$row["date"].'</td>
			</tr>
		';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>