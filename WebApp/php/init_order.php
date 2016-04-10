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

$queryString = "SELECT * FROM `tab` WHERE venue_id = '" . $_SESSION["ID"] . "'";
$result = $conn->query($queryString);

$outputString = "<div class = 'row'><div class = 'col-md-12'>\n"
			. "<!-- Button trigger settings modal -->\n"
			. "<button onclick = 'initSettings()' type='button' class='btn btn-primary btn-lg'>Settings</button>\n"
			. "<!-- Button trigger view modal -->\n"
			. "<button type='button' class='btn btn-primary btn-lg' onclick = 'ViewInitialization()'>View Drinks</button>\n"
			. "</div></div>\n"
			. "<div class = 'row'><div class = 'col-md-12'>\n"
			. "<h2>Orders</h2>\n"
			. "</div></div>\n"
			. "<div class = 'row'>\n";
if ($result->num_rows != 0){
	while($row = $result->fetch_assoc()){
		$outputString .= "<div class = 'col-md-4'>\n"
		. "<table class = 'table'>\n"
		. "<tr><td>CustID</td> <td>" . $row["customer_id"] . "</td></tr>\n"
		. "<tr><td>Status</td>\n"
		. "<td>" . $row["status"] . "<button type = 'button' class = 'btn btn-default'>-</button>\n"
		. "<button type = 'button' class = 'btn btn-primary'>+</button></td></tr>\n"
		. "<tr><td>Table</td> <td>" . $row["table_number"] . "</td></tr>\n"
		. "<tr><td>Order Time</td> <td>" . $row["start_time"] . "</td></tr>\n"
		. "<tr><td>Drinks</td> <td><button type = 'button' class = 'btn btn-primary'>View</button></td></tr>\n"
		. "</table>\n"
		. "</div>\n";
	}
}

$outputString .= "</div>\n";
echo $outputString;

?>