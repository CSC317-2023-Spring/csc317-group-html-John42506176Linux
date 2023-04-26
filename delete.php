<?php
    header('Content-Type: application/json');
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
    $sql = "DELETE FROM weather_table;";
    $conn->query($sql);
    print json_encode("Success");


    // Close the database connection
    $conn->close();
	?>