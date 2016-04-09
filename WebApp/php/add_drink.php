<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'uh-oh';
	exit();
}

$q = $_REQUEST["q"];
$stringArray = explode(",", $q);

/*establish connection with the mySQL database*/
$servername = "tund";
$username = "eld66";
$password = "cs477rocks";
$dbname = "eld66";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM `venue` WHERE id = '" . $_SESSION["ID"] . "' AND password = '" . $stringArray[0] . "'");
if ($result->num_rows == 0){
	echo 'no';
	exit();
}

$queryString = "INSERT INTO `drink`(`venue_id`, `cost`, `name`, `type`, `description`) VALUES ('"
. $_SESSION["ID"] . "','" . $stringArray[2] . "','"
. $stringArray[1] . "','" . $stringArray[3] . "','"
. $stringArray[4] . "')";

$conn->query($queryString);

echo 'Drink added successfully';

?>