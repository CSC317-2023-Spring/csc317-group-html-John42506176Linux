<html>
<head>
<title>PHP Test</title>
</head>
<body>
<li><a href="index.html">Initial form</a></li>
<?php 

$servername = "localhost";
$username = "root";
$password = "Isagi11*";
$dbname = "test";
$firstName = $_GET["fname"];
$lastName = $_GET["lname"];
$emailAddress = $_GET["email"];
$streetAddress = $_GET["sadress"];


$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "INSERT INTO testClass (firstName, lastName, emailAddress, streetAddress) VALUES ('$firstName', '$lastName', '$emailAddress', '$streetAddress')";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>
<br>
Welcome : <?php echo $_GET["fname"]; ?> <br>


Here are all the active Users: <br>


<?php 

$sql = "SELECT firstName, lastName, emailAddress, streetAddress FROM testClass";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $firstName = $row["firstName"];
    $lastName = $row["lastName"];
    $emailAddress = $row["emailAddress"];
    $streetAddress = $row["streetAddress"];
    echo "FirstName:  $firstName LastName: $lastName Email Address: $emailAddress Street Address: $streetAddress <br><br> ";
  }
} else {
  echo "0 results";
}

 ?>
</body>
</html>