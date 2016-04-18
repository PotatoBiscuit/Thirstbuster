<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error on init_order.php, no session ID';
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

$queryString = "SELECT * FROM `tab` WHERE venue_id = '" . $_SESSION["ID"] . "' AND status <> 'Complete' ORDER BY id ASC";
$result = $conn->query($queryString);
$outputString = "";

if ($result->num_rows != 0){
	while($row = $result->fetch_assoc()){
		$result1 = $conn->query("SELECT * FROM customer WHERE id = '" . $row["customer_id"] . "'");
		$row1 = $result1->fetch_assoc();
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
		if($row["table_number"] == 0){
			$table_number = "Self-serve";
		}
		else{
			$table_number = $row["table_number"];
		}
		$outputString .= "<div class = 'col-md-4'>\n"
		. "<table class = 'table'>\n"
		. "<tr><td>Customer Name</td> <td>" . $row1["name"] . "</td></tr>\n"
		. "<tr><td>Status</td>\n"
		. "<td>" . $row["status"] . " <button onclick = 'changeStatusMinus(" . $row["id"] . ", 1)' onkeypress = 'changeStatusMinus(" . $row["id"] . ", 1)' type = 'button' class = 'btn btn-default'>-</button>\n"
		. "<button onclick = 'changeStatusPlus(" . $row["id"] . ", 1)' onkeypress = 'changeStatusPlus(" . $row["id"] . ", 1)' type = 'button' class = 'btn btn-primary'>+</button></td></tr>\n"
		. "<tr><td>Table</td> <td>" . $table_number . "</td></tr>\n"
		. "<tr><td>Wait Time</td> <td>" . $elapsedTime . "</td></tr>\n"
		. "<tr><td>Drinks</td> <td><button onclick = 'viewOrderedDrinks(" . $row["id"] . ")' onkeypress = 'viewOrderedDrinks(" . $row["id"] . ")' type = 'button' class = 'btn btn-primary'>View</button></td></tr>\n"
		. "<tr><td>Action</td> <td><button onclick = 'deleteOrder(" . $row["id"] . ")' onkeypress = 'deleteOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-primary'>Delete</button>\n"
		. "<button onclick = 'finishOrder(" . $row["id"] . ")' onkeypress = 'finishOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-success'>Finish</button></td></tr>\n"
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