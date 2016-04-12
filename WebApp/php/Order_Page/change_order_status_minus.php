<?php
session_start();

$q = $_REQUEST["q"];

/*establish connection with the mySQL database*/
$servername = "tund";
$username = "eld66";
$password = "cs477rocks";
$dbname = "eld66";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
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