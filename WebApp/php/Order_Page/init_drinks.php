<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in init_drinks.php, no session ID';
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

$queryString = "SELECT drink.name, customer.name AS cust_name, tab.start_time, tab.id, tab.status, tab.table_number FROM drink "
. "INNER JOIN tab_drinks ON drink.id = tab_drinks.drink_id "
. "INNER JOIN tab ON tab_drinks.tab_id = tab.id "
. "INNER JOIN customer ON tab.customer_id = customer.id "
. "WHERE tab.status <> 'Complete' "
. "ORDER BY drink.name ASC";
$result = $conn->query($queryString);
$outputString = "";

if ($result->num_rows != 0){
	while($row = $result->fetch_assoc()){
		
		$currentTime = getdate();
		$orderTime = explode(" ", $row["start_time"]);
		$orderTime = explode(":", $orderTime[1]);
		if($currentTime["seconds"] < $orderTime[2]){
			$currentTime["seconds"] = $currentTime["seconds"] + 60;
			$currentTime["minutes"] = $currentTime["minutes"] - 1;
		}
		if($currentTime["minutes"] < $orderTime[1]){
			$currentTime["minutes"] = $currentTime["minutes"] + 60;
			$currentTime["hours"] = $currentTime["hours"] - 1;
		}
		if($currentTime["hours"] < $orderTime[0]){
			$currentTime["hours"] = $currentTime["hours"] + 24;
		}
		$elapsedTime = ($currentTime["hours"] - $orderTime[0]) . ":"
		. ($currentTime["minutes"] - $orderTime[1]) . ":"
		. ($currentTime["seconds"] - $orderTime[2]);
		$outputString .= "<div class = 'col-md-4'>\n"
		. "<table id = 'order_table' class = 'table' style = 'background-color: rgba(0,255,0,.5);'>\n"
		. "<thead class='thead-inverse'><tr id = 'order_rows'><td>Drink Name</td> <td>" . $row["name"] . "</td></tr></thead>\n"
		. "<tr id = 'order_rows'><td>Customer Name</td> <td>" . $row["cust_name"] . "</td></tr>\n"
		. "<tr id = 'order_rows'><td>Status</td>\n"
		. "<td id = 'order_rows'>" . $row["status"] . "</td></tr>\n"
		. "<tr><td>Table</td> <td>" . $row["table_number"] . "</td></tr>\n"
		. "<tr><td>Wait Time</td> <td>" . $elapsedTime . "</td></tr>\n"
		. "</table>\n"
		. "</div>\n";
	}
}
else{
	$outputString .= "No results to display";
}

$outputString .= "</div>\n";
echo $outputString;

?>