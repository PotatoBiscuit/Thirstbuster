<?php

/*establish connection with the mySQL database*/
$servername = "tund";
$username = "eld66";
$password = "cs477rocks";
$dbname = "eld66";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$q = $_REQUEST["q"];

$queryString = "SELECT * FROM `drink` WHERE id = '" . $q . "'";
$result = $conn->query($queryString);
if ($result->num_rows == 0 || $result->num_rows > 1){
	echo 'oh-no';
	exit();
}

$row = $result->fetch_assoc();
$infoString = $row["name"] . "," . $row["cost"] . "," . $row["type"] . "," . $row["description"];
echo $infoString;
?>

