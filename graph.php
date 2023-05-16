<?php
// Assuming you have a database connection established
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
  // Query to fetch distinct runID values from the database
$query = "SELECT DISTINCT runID FROM pi_table";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result) {
    // Create an array to store the runID values
    $runIDs = array();

    // Fetch the runID values and add them to the array
    while ($row = mysqli_fetch_assoc($result)) {
        $runIDs[] = $row['runID'];
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>ChartJS - BarGraph</title>
    <style type="text/css">
      #chart-container {
        width: 640px;
        height: auto;
      }
    </style>
  </head>
  <body>
    <div style="width: 50%; height: 30%;"><canvas id="canvasL1"></canvas></div>
    <div style="width: 50%; height: 30%;"><canvas id="canvasR1"></canvas></div>
    <br>
    <div style="width: 50%; height: 30%;"><canvas id="canvasL2"></canvas></div>
    <div style="width: 50%; height: 30%;"><canvas id="canvasR2"></canvas></div>
    <rb></rb>
    <form id = "my-form" method="POST">
    <label for="runID1">Run ID 1:</label><br>
    <select id="runID1" name="runID1">
        <?php
        // Loop through the runID values and create option tags
        foreach ($runIDs as $runID) {
            echo "<option value='$runID'>$runID</option>";
        }
        ?>
    </select>
    <!-- <label for="runID2">Run ID 2:</label><br>
    <select id="runID2" name="runID2">
        <?php
        // Loop through the runID values and create option tags
        // foreach ($runIDs as $runID) {
        //     echo "<option value='$runID'>$runID</option>";
        // }
        ?> -->
    </select>
    <input type="submit" value="Submit">
    </form>
    <button id ="delete"> Delete database</button>

    <!-- javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-trendline"></script>
    <script type="text/javascript" src="app.js"></script>
  </body>
</html>