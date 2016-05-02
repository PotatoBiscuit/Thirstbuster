<?php
session_start();

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


$result = $conn->query("SELECT * FROM `venue` WHERE login_name = '" . $stringArray[0] . "'");
if ($result->num_rows == 0){
	echo 'no';
	exit();
}
else {
	$result = $conn->query("SELECT * FROM `venue` WHERE login_name = '" . $stringArray[0] . "' AND password = '" . $stringArray[1] . "'");
	if ($result->num_rows == 0){
		echo 'no1';
		exit();
	}
}

$row = $result->fetch_assoc();
$_SESSION['ID'] = $row["id"];
$_SESSION['LoginID'] = $row["login_name"];
echo 'yes';
?>