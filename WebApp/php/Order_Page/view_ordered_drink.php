<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in view_ordered_drink.php, no session ID';
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

$queryString = "SELECT * FROM tab_drinks WHERE tab_id = '" . $q . "'";
$result = $conn->query($queryString);

if ($result->num_rows == 0){
	echo 'No results to display';
	exit();
}
else{
	$str = "<table class = 'table'>\n"
	. "<tr><th>Name</th><th>Cost</th><th>Special Instructions</th><th>Drink Status</th><th>Action</th></tr>";
	$i = 1;
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
		. $row["special_instructions"] . "</td><td>"
		. $row["drink_status"] . "</td><td>"
		. "<button onclick = 'deleteOrderedDrink(" . $row["tab_drink_id"] . "," . $q . ")' onkeypress = 'deleteOrderedDrink(" . $row["tab_drink_id"] . "," . $q . ")' type = 'button' class = 'btn btn-danger'>Delete</button>\n"
		. "<button onclick = 'finishOrderedDrink(" . $row["tab_drink_id"] . "," . $q . ")' onkeypress = 'finishOrderedDrink(" . $row["tab_drink_id"] . "," . $q . ")' type = 'button' class = 'btn btn-success'>Fill</button></td>"
		. "</tr>\n";
		$i = $i + 1;
	}
	$str .= "</table>\n";
}

echo $str;

?>