<?php
session_start();
if(!isset($_SESSION["ID"])){
	echo 'Error in settings.php, no session ID';
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

$queryString = "SELECT * FROM `venue` WHERE id = '" . $_SESSION["ID"] . "'";
$result = $conn->query($queryString);
if ($result->num_rows == 0){
	echo $queryString . "I'm afraid you don't exist";
	exit();
}

$row = $result->fetch_assoc();
if($row["password"] != $stringArray[1]){
	echo "Incorrect password";
	exit();
}

$queryString = "UPDATE `venue` SET address = '" . $stringArray[3]
. "', city = '" . $stringArray[4] . "', state = '" . $stringArray[5]
. "', zip = '" . $stringArray[6]
. "', name = '" . $stringArray[2] . "', credit = '"
. $stringArray[7] . "', login_name = '" . $stringArray[0]
. "' WHERE id = '" . $_SESSION["ID"] . "'";

$conn->query($queryString);

echo "Info updated successfully";


?>