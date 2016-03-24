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

$queryString = "INSERT INTO `venue`(`address`, `password`, `name`, `credit`, `login_name`) VALUES ('"
. $stringArray[3] . "','" . $stringArray[1] . "','"
. $stringArray[2] . "','" . $stringArray[4] . "','"
. $stringArray[0] . "')";

$conn->query($queryString);

$result = $conn->query("SELECT * FROM `venue` WHERE login_name = '" . $stringArray[0] . "' AND password = '" . $stringArray[1] . "'");
$row = $result->fetch_assoc();
$_SESSION['ID'] = $row["id"];
?>