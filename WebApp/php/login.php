<?php
session_start();

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
echo 'yes';
?>