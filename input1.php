<!DOCTYPE html>
<html>
<head>
	<title>Weather Data Table</title>
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
	<h1>Weather Data Table</h1>

<form method="GET">
	ID: <input type="text" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>"><br>
	Date: <input type="text" name="date" value="<?php echo isset($_GET['date']) ? $_GET['date'] : '' ?>">
	Wind Speed: <input type="number" name="windspeed" value="<?php echo isset($_GET['windspeed']) ? $_GET['windspeed'] : '' ?>"><br>
	Wind Direction: <input type="number" name="winddirection" value="<?php echo isset($_GET['winddirection']) ? $_GET['winddirection'] : '' ?>"><br>
	Air Temperature: <input type="number" name="airtemp" value="<?php echo isset($_GET['airtemp']) ? $_GET['airtemp'] : '' ?>"><br>
	Relative Humidity: <input type="number" name="humidity" value="<?php echo isset($_GET['humidity']) ? $_GET['humidity'] : '' ?>"><br>
	Rainfall: <input type="number" name="rainfall" value="<?php echo isset($_GET['rainfall']) ? $_GET['rainfall'] : '' ?>"><br>
	Downwelling shortwave radiation: <input type="number" name="shortwave" value="<?php echo isset($_GET['shortwave']) ? $_GET['shortwave'] : '' ?>"><br>
	Downwelling longwave radiation: <input type="number" name="longwave" value="<?php echo isset($_GET['longwave']) ? $_GET['longwave'] : '' ?>"><br>
	Barometric pressure: <input type="number" name="pressure" value="<?php echo isset($_GET['pressure']) ? $_GET['pressure'] : '' ?>"><br>
	Sea surface temperature: <input type="number" name="surfacetemp" value="<?php echo isset($_GET['surfacetemp']) ? $_GET['surfacetemp'] : '' ?>"><br>
	Subsurface Sea temperature: <input type="number" name="subsurfacetemp" value="<?php echo isset($_GET['subsurfacetemp']) ? $_GET['subsurfacetemp'] : '' ?>"><br>
	Salinity: <input type="number" name="salinity" value="<?php echo isset($_GET['salinity']) ? $_GET['salinity'] : '' ?>"><br>
	Water pressure: <input type="number" name="waterpressure" value="<?php echo isset($_GET['waterpressure']) ? $_GET['waterpressure'] : '' ?>"><br>
	Ocean current: <input type="number" name="current" value="<?php echo isset($_GET['current']) ? $_GET['current'] : '' ?>"><br>
	<input type="submit" value="Submit">
    </form>

	<?php
	$servername = "localhost";
    $username = "root";
    $password = "Isagi11*";
	$dbname = "Weather";
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

$id = $_GET['id'];
$date = $_GET['date'];
$wind_speed = $_GET['windspeed'];
$wind_direction = $_GET['winddirection'];
$air_temperature = $_GET['airtemp'];
$relative_humidity = $_GET['humidity'];
$rainfall = $_GET['rainfall'];
$downwelling_shortwave_radiation = $_GET['shortwave'];
$downwelling_longwave_radiation = $_GET['longwave'];
$barometric_pressure = $_GET['pressure'];
$sea_surface_temperature = $_GET['surfacetemp'];
$subsurfacetemp = $_GET['subsurfacetemp'];
$salinity = $_GET['salinity'];
$water_pressure = $_GET['waterpressure'];
$ocean_current = $_GET['current'];


$sql = "INSERT INTO weather_table (date, id, windspeed, winddirection, airtemp, humidity, rainfall, shortwave, longwave, pressure, surfacetemp, subsurfacetemp, salinity, waterpressure, current) VALUES ('$date', $id, $wind_speed , $wind_direction, $air_temperature,$relative_humidity, $rainfall , $downwelling_shortwave_radiation , $downwelling_longwave_radiation, $barometric_pressure , $salinity, $water_pressure, 35, 100, 696969);";
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


