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

$queryString = "SELECT tab.id, tab.delivery_time, customer.name, tab.status FROM tab INNER JOIN customer ON tab.customer_id = customer.id WHERE status = 'Complete' "
. "AND customer.name LIKE '%" . $q . "%' ORDER BY customer.name ASC LIMIT 5";
$result = $conn->query($queryString);

if ($result->num_rows == 0){
	echo 'No results to display';
	exit();
}
else{
	while($row = $result->fetch_assoc()){
		$echoString .= "<b>Customer Name: " . $row["name"] . "</b><br>"
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