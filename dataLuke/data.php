<!DOCTYPE html>
<html>
<head>
	<title>Car Data Table</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}
		th, td {
			text-align: left;
			padding: 8px;
			border: 1px solid black;
		}
		th {
			background-color: #4CAF50;
			color: white;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
</head>
<body>
	<h1>Car Data Table</h1>

	<?php
	$servername = "localhost";
    $username = "root";
    $password = "Isagi11*";
	$dbname = "CarData";
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

$runID = $_POST['runID'];
$timestamp = $_POST['timestamp'];
$leftwheel = $_POST['leftwheel'];
$rightwheel = $_POST['rightwheel'];
$sensor = $_POST['sensor'];
$obstacle = $_POST['obstacle'];

$sql = "INSERT INTO pi_table (runID, timestamp, leftwheel, rightwheel, sensor, obstacle) VALUES ('$runID', '$timestamp', '$leftwheel', '$rightwheel', '$sensor', '$obstacle');";
$result =  $conn->query($sql);



if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
	http_response_code(200);
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
	http_response_code(404);
  }
  
?>


</html>