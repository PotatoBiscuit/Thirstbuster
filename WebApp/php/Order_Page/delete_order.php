<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in delete_order.php, no session ID';
	exit();
}

$q = $_REQUEST["q"];

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

$queryString = "DELETE FROM tab WHERE id = '" . $q . "'";
$result = $conn->query($queryString);

$queryString = "DELETE FROM tab_drinks WHERE tab_id = '" . $q . "'";
$result = $conn->query($queryString);

?>