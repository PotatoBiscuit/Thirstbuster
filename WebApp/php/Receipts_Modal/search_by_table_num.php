<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in view_ordered_drink.php, no session ID';
	exit();
}

$q = $_REQUEST["q"];
if($q == "Self-serve"){
	$q = 0;
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

$queryString = "SELECT tab.id, tab.delivery_time, customer.name, tab.status, tab.table_number FROM tab INNER JOIN customer ON tab.customer_id = customer.id WHERE status = 'Complete' "
. "AND tab.venue_id = '" . $_SESSION["ID"] . "' AND tab.table_number LIKE '%" . $q . "%' ORDER BY tab.table_number ASC LIMIT 5";
$result = $conn->query($queryString);

if ($result->num_rows == 0){
	echo 'No results to display';
	exit();
}
else{
	while($row = $result->fetch_assoc()){
		if($row["table_number"] == 0){
			$row["table_number"] = 'Self-serve';
		}
		$echoString .= "<b>Table Number: " . $row["table_number"] . "</b><br>"
		. "Customer Name: " . $row["name"] . "<br>"
		. "Delivery Time: " . $row["delivery_time"] . "<br>";
		
		$queryString = "SELECT * FROM tab_drinks INNER JOIN drink ON tab_drinks.drink_id = drink.id WHERE tab_id = '" . $row["id"] . "'";
		$result1 = $conn->query($queryString);
		
		if($result->num_rows == 0){
			$echoString .= "Price: $0<br>";
		}
		else{
			$TotalPrice = 0;
			while($row1 = $result1->fetch_assoc()){
				$TotalPrice = $TotalPrice + $row1["cost"];
			}
			$echoString .= "Price: $" . $TotalPrice . "<br>";
		}
		$echoString .= "Status: " . $row["status"] . "<br><br>";
	}
}

echo $echoString;


?>