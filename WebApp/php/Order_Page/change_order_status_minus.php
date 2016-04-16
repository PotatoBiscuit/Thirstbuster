<?php
session_start();

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

$result = $conn->query("SELECT status FROM tab WHERE id = '" . $q . "'");
$row = $result->fetch_assoc();
if($row["status"] == "Filling"){
	$newStatus = "Ordered";
}
else if($row["status"] == ""){
	$newStatus = "Ordered";
}
else if($row["status"] == "Delivering"){
	$newStatus = "Filling";
}
else{
	$newStatus = $row["status"];
}
$conn->query("UPDATE tab SET status = '" . $newStatus . "' WHERE id = '" . $q . "'");

echo "Changed Successfully";
?>