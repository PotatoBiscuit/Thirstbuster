<?php

session_start();

if(!isset($_SESSION["ID"])){
	echo 'uh-oh';
	exit();
}

/*establish connection with the mySQL database*/
$servername = "tund";
$username = "eld66";
$password = "cs477rocks";
$dbname = "eld66";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error){
	die("Connection failed: " . $conn->connect_error);
}

$queryString = "SELECT * FROM `drink` WHERE venue_id = '" . $_SESSION["ID"] . "'";

$result = $conn->query($queryString);

if ($result->num_rows == 0){
	echo 'No results to display';
	exit();
}
else {
	$str = "<table class = 'table'>\n"
	. "<tr><th>Name</th><th>Type</th><th>Cost</th><th>Description</th></tr>";
	while($row = $result->fetch_assoc()){
		$str .= "<tr>\n<td>"
		. $row["name"] . "</td><td>"
		. $row["type"] . "</td><td>"
		. $row["cost"] . "</td><td>"
		. $row["description"] . "</td><td>\n"
		. "<button onclick = 'delDrink(" . $row["id"] . ")' type = 'submit' class = 'btn btn-primary'>Delete</button>\n" . "</td><td>\n"
		. "<button onclick = 'initEditDrink(" . $row["id"] . ")' type = 'submit' class = 'btn btn-default'>Edit</button>\n" . "</td>\n"
		."</tr>\n";
	}
	$str .= "</table>\n";
}

echo $str;

?>
