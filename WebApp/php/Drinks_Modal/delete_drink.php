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

$queryString = "DELETE FROM `drink` WHERE id = '" . $q . "'";
$conn->query($queryString);

echo "Drink Deleted";
?>