<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error with edit_drink.php, no session ID';
	exit();
}

$q = $_REQUEST["q"];
$stringArray = explode(",", $q);

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

$queryString = "SELECT venue_id FROM `drink` WHERE id = '" . $stringArray[0] . "'";
$result = $conn->query($queryString);
if($result->num_rows == 0 || $result->num_rows > 1){
	echo 'oh-no';
	exit();
}
$row = $result->fetch_assoc();

$venue_id = $row["venue_id"];
$queryString = "SELECT * FROM `venue` WHERE id = '" . $venue_id . "' AND password = '" . $stringArray[1] . "'";
$result = $conn->query($queryString);
if($result->num_rows == 0){
	echo 'Incorrect Password';
	exit();
}

$queryString = "UPDATE `drink` SET cost = '" . $stringArray[3]
. "', name = '" . $stringArray[2] . "', type = '"
. $stringArray[4] . "', description = '" . $stringArray[5]
. "' WHERE id = '" . $stringArray[0] . "'";
$result = $conn->query($queryString);
echo 'Drink Correctly Changed';

?>