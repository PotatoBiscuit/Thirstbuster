<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'uh-oh';
	exit();
}

$q = $_REQUEST["q"];

/*establish connection with the mySQL database*/
$servername = "tund";
$username = "eld66";
$password = "cs477rocks";
$dbname = "eld66";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$currentTime = getdate();
$timeString = $currentTime["year"] . "-" . $currentTime["mon"] . "-" . $currentTime["mday"] . " "
. $currentTime["hours"] . ":" . $currentTime["minutes"] . ":" . $currentTime["seconds"];

$queryString = "UPDATE tab SET delivery_time = '" . $timeString . "', status = 'Complete' WHERE id = '" . $q . "'";
$result = $conn->query($queryString);
?>