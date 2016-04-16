<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in finish_order.php, no session ID';
	exit();
}

$q = $_REQUEST["q"];

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

$currentTime = getdate();
$timeString = $currentTime["year"] . "-" . $currentTime["mon"] . "-" . $currentTime["mday"] . " "
. $currentTime["hours"] . ":" . $currentTime["minutes"] . ":" . $currentTime["seconds"];

$queryString = "UPDATE tab SET delivery_time = '" . $timeString . "', status = 'Complete' WHERE id = '" . $q . "'";
$result = $conn->query($queryString);
?>