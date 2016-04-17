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
		. $row["drink_status"]
		. "<button onclick = 'changeDrinkStatusMinus(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' onkeypress = 'changeDrinkStatusMinus(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' type = 'button' class = 'btn btn-default'>-</button>\n"
		. "<button onclick = 'changeDrinkStatusPlus(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' onkeypress = 'changeDrinkStatusPlus(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' type = 'button' class = 'btn btn-primary'>+</button>"
		. "</td><td>"
		. "<button onclick = 'deleteOrderedDrink(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' onkeypress = 'deleteOrderedDrink(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' type = 'button' class = 'btn btn-primary'>Delete</button>\n"
		. "<button onclick = 'finishOrderedDrink(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' onkeypress = 'finishOrderedDrink(" . $row["tab_id"] . ", " . $row["drink_id"] . ")' type = 'button' class = 'btn btn-success'>Finish</button></td>"
		. "</tr>\n";
	}
	$str .= "</table>\n";
}

echo $str;

?>