<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in init_settings.php, no session ID';
	exit();
}

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

$queryString = "SELECT * FROM `venue` WHERE id = '" . $_SESSION["ID"] . "'";

$result = $conn->query($queryString);
if ($result->num_rows == 0 || $result->num_rows > 1){
	echo 'Error in init_settings, there is not exactly 1 entry for your ID';
	exit();
}

$row = $result->fetch_assoc();
$infoString = $row["login_name"] . "," . $row["name"] . "," . $row["address"] . ","
. $row["city"] . "," . $row["state"] . "," . $row["zip"] . "," . $row["credit"];
echo $infoString;
?>



