<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in delete_order.php, no session ID';
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

$queryString = "UPDATE tab_drinks SET drink_status = 'Filled' WHERE tab_drink_id = '"
. $stringArray[0] . "' AND drink_status <> 'Filled'";
$result = $conn->query($queryString);

$queryString = "SELECT * FROM tab WHERE id = '" . $stringArray[1] . "' AND status = 'Ordered'";
$result = $conn->query($queryString);

if ($result->num_rows != 0){
	$queryString = "UPDATE tab SET status = 'Filling' WHERE id = '" . $stringArray[1] . "'";
	$conn->query($queryString);
}

$queryString = "SELECT * FROM tab_drinks WHERE tab_id = '" . $stringArray[1] . "'";
$queryString1 = "SELECT * FROM tab_drinks WHERE tab_id = '" . $stringArray[1] . "' AND drink_status = 'Filled'";

$result = $conn->query($queryString);
$result1 = $conn->query($queryString1);

if($result->num_rows == $result1->num_rows){
	$queryString = "UPDATE tab SET status = 'Delivering' WHERE id = '" . $stringArray[1] . "'";
	$conn->query($queryString);
}

?>