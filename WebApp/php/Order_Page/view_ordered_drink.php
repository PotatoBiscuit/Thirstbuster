<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'uh-oh';
	exit();
}

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

$queryString = "SELECT * FROM tab_drinks WHERE tab_id = '" . $q . "'";
$result = $conn->query($queryString);

if ($result->num_rows == 0){
	echo 'No results to display';
	exit();
}
else{
	$str = "<table class = 'table'>\n"
	. "<tr><th>Name</th><th>Cost</th><th>Special Instructions</th></tr>";
	while($row = $result->fetch_assoc()){
		$result1 = $conn->query("SELECT * FROM drink WHERE id = '" . $row["drink_id"] . "'");
		if($result1->num_rows == 0){
			echo 'No results to display';
			exit();
		}
		$row1 = $result1->fetch_assoc();
		$str .= "<tr>\n<td>"
		. $row1["name"] . "</td><td>"
		. $row1["cost"] . "</td><td>"
		. $row["special_instructions"] . "</td>\n"
		."</tr>\n";
	}
	$str .= "</table>\n";
}

echo $str;

?>