<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in num_drinks.php, no session ID';
	exit();
}

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

$queryString = "SELECT * FROM tab WHERE status = 'Complete' AND venue_id = '" . $_SESSION["ID"] . "'";
$result = $conn->query($queryString);
$num_orders_finished = $result->num_rows;

echo "<center><h3>Number of Completed Orders: </h3><h2>" . $num_orders_finished . "</h2></center>";

?>

