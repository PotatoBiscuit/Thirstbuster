<?php

session_start();

/*establish connection with the mySQL database*/
$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
	echo 'Error in connecting to database';
	die("Connection failed: " . $conn->connect_error);
}

$q = $_REQUEST["q"];

$queryString = "SELECT * FROM `drink` WHERE id = '" . $q . "'";
$result = $conn->query($queryString);
if ($result->num_rows == 0 || $result->num_rows > 1){
	echo 'Error with init_edit_drink.php, no rows found';
	exit();
}

$row = $result->fetch_assoc();
$infoString = $row["name"] . "," . $row["cost"] . "," . $row["type"] . "," . $row["description"];
echo $infoString;
?>

