<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'uh-oh';
	exit();
}

/*establish connection with the mySQL database*/
$servername = "tund";
$username = "eld66";
$password = "cs477rocks";
$dbname = "eld66";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$queryString = "SELECT * FROM `venue` WHERE id = '" . $_SESSION["ID"] . "'";

$result = $conn->query($queryString);
if ($result->num_rows == 0 || $result->num_rows > 1){
	echo 'uh-oh';
	exit();
}

$row = $result->fetch_assoc();
$infoString = $row["login_name"] . "," . $row["name"] . "," . $row["address"] . ","
. $row["city"] . "," . $row["state"] . "," . $row["zip"] . "," . $row["credit"];
echo $infoString;
?>



