<?php
session_start();

$q = $_REQUEST["q"];
$stringArray = explode(",", $q);

/*establish connection with the mySQL database*/
$_SESSION["servername"] = "tund.cefns.nau.edu";
$_SESSION["username"] = "eld66";
$_SESSION["password"] = "cs477rocks";
$_SESSION["dbname"] = "eld66";

$servername = $_SESSION["servername"];
$username = $_SESSION["username"];
$password = $_SESSION["password"];
$dbname = $_SESSION["dbname"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
	echo 'Error in connecting to database';
	die("Connection failed: " . $conn->connect_error);
}


$result = $conn->query("SELECT * FROM `venue` WHERE login_name = '" . $stringArray[0] . "'");
if ($result->num_rows == 0){
	echo 'Error with logging in';
	exit();
}
else {
	$result = $conn->query("SELECT * FROM `venue` WHERE login_name = '" . $stringArray[0] . "' AND password = '" . $stringArray[1] . "'");
	if ($result->num_rows == 0){
		echo 'Error with Logging in';
		exit();
	}
}

$row = $result->fetch_assoc();
$_SESSION['ID'] = $row["id"];
echo 'yes';
?>