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
	
	<form method="POST">
	ID: <input type="text" name="id" value="<?php echo isset($_POST['id']) ? $_POST['id'] : '' ?>"><br>
	Start_date: <input type="text" name="start-date" value="<?php echo isset($_POST['start-date']) ? $_POST['start-date'] : '' ?>">
	End_date: <input type="text" name="end-date" value="<?php echo isset($_POST['end-date']) ? $_POST['end-date'] : '' ?>"><br>
	Wind Speed: <input type="number" name="windspeed" value="<?php echo isset($_POST['windspeed']) ? $_POST['windspeed'] : '' ?>"><br>
	Wind Direction: <input type="text" name="winddirection" value="<?php echo isset($_POST['winddirection']) ? $_POST['winddirection'] : '' ?>"><br>
	Air Temperature: <input type="number" name="airtemp" value="<?php echo isset($_POST['airtemp']) ? $_POST['airtemp'] : '' ?>"><br>
	Relative Humidity: <input type="number" name="humidity" value="<?php echo isset($_POST['humidity']) ? $_POST['humidity'] : '' ?>"><br>
	Rainfall: <input type="number" name="rainfall" value="<?php echo isset($_POST['rainfall']) ? $_POST['rainfall'] : '' ?>"><br>
	Downwelling shortwave radiation: <input type="number" name="shortwave" value="<?php echo isset($_POST['shortwave']) ? $_POST['shortwave'] : '' ?>"><br>
	Downwelling longwave radiation: <input type="number" name="longwave" value="<?php echo isset($_POST['longwave']) ? $_POST['longwave'] : '' ?>"><br>
	Barometric pressure: <input type="number" name="pressure" value="<?php echo isset($_POST['pressure']) ? $_POST['pressure'] : '' ?>"><br>
	Sea surface temperature: <input type="number" name="surfacetemp" value="<?php echo isset($_POST['surfacetemp']) ? $_POST['surfacetemp'] : '' ?>"><br>
	Subsurface Sea temperature: <input type="number" name="subsurfacetemp" value="<?php echo isset($_POST['subsurfacetemp']) ? $_POST['subsurfacetemp'] : '' ?>"><br>
	Salinity: <input type="number" name="salinity" value="<?php echo isset($_POST['salinity']) ? $_POST['salinity'] : '' ?>"><br>
	Water pressure: <input type="number" name="waterpressure" value="<?php echo isset($_POST['waterpressure']) ? $_POST['waterpressure'] : '' ?>"><br>
	Ocean current: <input type="text" name="current" value="<?php echo isset($_POST['current']) ? $_POST['current'] : '' ?>"><br>


      <input type="submit" value="Submit">
    </form>

	<?php
	// Create a database connection
	$servername = "localhost";
    $username = "root";
    $password = "Isagi11*";
    $dbname = "test";
	$dbname = "Weather";
	$conn = new mysqli($servername, $username, $password, $dbname);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}


	// Query the database for weather data
	$sql = "SELECT * FROM weather_table";

	$first_where = true;

	if (isset($_POST['id']) && $_POST['id'] != "") {
        $id = $_POST['id'];
		if($first_where) {
			$sql .= ' WHERE id = '.$id;
			$first_where = false;
		}
		else{
			$sql .= ' AND id = '.$id;
			$first_where = false;
		}
    }
	if (isset($_POST['start-date']) && $_POST['start-date'] != "") {
        $start_date= $_POST['start-date'];
		if($first_where) {
			$sql .= " WHERE date >= '".$start_date ."'";
			$first_where = false;
		}
		else{
			$sql .= " AND date >= '".$start_date ."'";
		}
    }
	if (isset($_POST['end-date']) && $_POST['end-date'] != "") {
        $end_date = $_POST['end-date'];
		if($first_where) {
			$sql .= " WHERE date <= '".$end_date ."'";
			$first_where = false;
		}
		else{
			$sql .= " AND date <= '".$end_date ."'";
		}
    }

	if (isset($_POST['windspeed']) && $_POST['windspeed'] != "") {
		$windspeed = $_POST['windspeed'];
		if ($first_where) {
			$sql .= " WHERE windspeed = ".$windspeed;
			$first_where = false;
		} else {
			$sql .= " AND windspeed = ".$windspeed;
		}
	}

	if (isset($_POST['airtemp']) && $_POST['airtemp'] != "") {
		$airtemp = $_POST['airtemp'];
		if ($first_where) {
			$sql .= " WHERE airtemp = ".$airtemp;
			$first_where = false;
		} else {
			$sql .= " AND airtemp = ".$airtemp;
		}
	}

	if (isset($_POST['wind_direction']) && $_POST['wind_direction'] != "") {
		$wind_direction = $_POST['wind_direction'];
		if($first_where) {
			$sql .= ' WHERE wind_direction = "'.$wind_direction.'"';
			$first_where = false;
		}
		else{
			$sql .= ' AND wind_direction = "'.$wind_direction.'"';
		}
	}

	if (isset($_POST['humidity']) && $_POST['humidity'] != "") {
		$humidity = $_POST['humidity'];
		if ($first_where) {
			$sql .= " WHERE humidity = ".$humidity;
			$first_where = false;
		} else {
			$sql .= " AND humidity = ".$humidity;
		}
	}

	if (isset($_POST['rainfall']) && $_POST['rainfall'] != "") {
		$rainfall = $_POST['rainfall'];
		if($first_where) {
			$sql .= ' WHERE rainfall = '.$rainfall;
			$first_where = false;
		}
		else{
			$sql .= ' AND rainfall = '.$rainfall;
		}
	}
	
	if (isset($_POST['shortwave']) && $_POST['shortwave'] != "") {
		$shortwave = $_POST['shortwave'];
		if($first_where) {
			$sql .= ' WHERE shortwave = '.$shortwave;
			$first_where = false;
		}
		else{
			$sql .= ' AND shortwave = '.$shortwave;
		}
	}
	
	if (isset($_POST['longwave']) && $_POST['longwave'] != "") {
		$longwave = $_POST['longwave'];
		if($first_where) {
			$sql .= ' WHERE longwave = '.$longwave;
			$first_where = false;
		}
		else{
			$sql .= ' AND longwave = '.$longwave;
		}
	}
	
	if (isset($_POST['pressure']) && $_POST['pressure'] != "") {
		$pressure = $_POST['pressure'];
		if($first_where) {
			$sql .= ' WHERE pressure = '.$pressure;
			$first_where = false;
		}
		else{
			$sql .= ' AND pressure = '.$pressure;
		}
	}
	
	if (isset($_POST['surfacetemp']) && $_POST['surfacetemp'] != "") {
		$surfacetemp = $_POST['surfacetemp'];
		if($first_where) {
			$sql .= ' WHERE surfacetemp = '.$surfacetemp;
			$first_where = false;
		}
		else{
			$sql .= ' AND surfacetemp = '.$surfacetemp;
		}
	}

	if (isset($_POST['subsurfacetemp']) && $_POST['subsurfacetemp'] != "") {
		$surfacetemp = $_POST['surfacetemp'];
		if($first_where) {
			$sql .= ' WHERE subsurfacetemp = '.$subsurfacetemp;
			$first_where = false;
		}
		else{
			$sql .= ' AND subsurfacetemp = '.$subsurfacetemp;
		}
	}

	if (isset($_POST['current']) && $_POST['current'] != "") {
		$current = $_POST['current'];
		if($first_where) {
			$sql .= ' WHERE current = "'.$current.'"';
			$first_where = false;
		} else {
			$sql .= ' AND current = "'.$current.'"';
		}
	}
	echo "<br>";
	echo "SQL: " . $sql ;
	echo "<br>";
	echo "<br>";
	$result = $conn->query($sql);

	// Check if any rows were returned
	if ($result->num_rows > 0) {
	    // Output the table header
	    echo "<table><tr><th>Date</th><th>ID</th><th>Wind Speed</th><th>Wind Direction</th><th>Air Temperature</th><th>Humidity</th><th>Rainfall</th><th>Shortwave Radiation</th><th>Longwave Radiation</th><th>Barometric Pressure</th><th>Surface Temperature</th><th>Subsurface Temperature</th><th>Salinity</th><th>Water Pressure</th><th>Ocean Current</th></tr>";

	    // Output each row of data
	    while($row = $result->fetch_assoc()) {
	        echo "<tr><td>".$row["date"]."</td><td>".$row["id"]."</td><td>".$row["windspeed"]."</td><td>".$row["winddirection"]."</td><td>".$row["airtemp"]."</td><td>".$row["humidity"]."</td><td>".$row["rainfall"]."</td><td>".$row["shortwave"]."</td><td>".$row["longwave"]."</td><td>".$row["pressure"]."</td><td>".$row["surfacetemp"]."</td><td>".$row["subsurfacetemp"]."</td><td>".$row["salinity"]."</td><td>".$row["waterpressure"]."</td><td>".$row["current"]."</td></tr>";
	    }

	    // Output the table footer
	    echo "</table>";
	} else {
	    echo "No weather data found.";
	}

	// Close the database connection
	$conn->close();
	?>
</body>
</html>