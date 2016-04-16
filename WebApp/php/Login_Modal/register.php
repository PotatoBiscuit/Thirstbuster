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

$queryString = "INSERT INTO `venue`(`address`, `city`, `state`, `zip`, `password`, `name`, `credit`, `login_name`) VALUES ('"
. $stringArray[3] . "','" . $stringArray[4] . "','" . $stringArray[5] . "','" . $stringArray[6] . "','"
. $stringArray[1] . "','"
. $stringArray[2] . "','" . $stringArray[7] . "','"
. $stringArray[0] . "')";

$conn->query($queryString);

$result = $conn->query("SELECT * FROM `venue` WHERE login_name = '" . $stringArray[0] . "' AND password = '" . $stringArray[1] . "'");
$row = $result->fetch_assoc();
$_SESSION['ID'] = $row["id"];
?>