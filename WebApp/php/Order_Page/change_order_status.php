<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error on init_order.php, no session ID';
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

$queryString = "UPDATE tab SET status = '" . $stringArray[1] . "' WHERE id = '" . $stringArray[0] . "'";
$conn->query($queryString);

?>