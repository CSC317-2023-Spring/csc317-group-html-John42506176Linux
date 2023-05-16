<?php
    header('Content-Type: application/json');
    // Create a database connection
    $servername = "localhost";
    $username = "root";
    $password = "Isagi11*";
	$dbname = "CarData";
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

        $sql = "SELECT * FROM pi_table";
        $result = $conn->query($sql);
        $data = array();
        // Check if any rows were returned
        if ($result->num_rows > 0) {

            // Output each row of data
            while($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->close();
            // Output the table footer
            print json_encode($data);
        } 


        // Close the database connection
        $conn->close();

    ?>