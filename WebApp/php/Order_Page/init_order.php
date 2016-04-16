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

$outputString = "<div class = 'row'><div class='col-md-1'></div><div class = 'col-md-2'>\n"
			. "<!-- Button trigger settings modal -->\n"
			. "<button onclick = 'initSettings()' type='button' class='btn btn-primary btn-lg'>Settings</button>\n"
			. "<!-- Button trigger view modal -->\n"
			. "</div><div class = 'col-md-2'>"
			. "<button type='button' class='btn btn-primary btn-lg' onclick = 'ViewInitialization()'>View Drinks</button>\n"
			. "</div><div class = 'col-md-2'>"
			. "<button type='button' class='btn btn-primary btn-lg' onclick = 'initOrder(1)'>Refresh Orders</button>\n"
			. "</div><div class = 'col-md-2'>"
			. "<button type='button' class='btn btn-primary btn-lg' onclick = 'initReports()'>View Reports</button>\n"
			. "</div><div class = 'col-md-2'>"
			. "<div class='dropdown'>"
		    . "<button class='btn btn-primary btn-lg dropdown-toggle' type='button' data-toggle='dropdown'>Sort By..."
		    . "<span class='caret'></span></button>"
		    . "<ul class='dropdown-menu'>"
			. "<li><a onclick='initOrder(1)' href='#'>Wait Time</a></li>"
			. "<li><a onclick='initOrder(2)' href='#'>Table Number</a></li>"
			. "<li><a onclick='initOrder(3)' href='#'>Customer Name</a></li>"
			. "<li><a onclick='initOrder(4)' href='#'>Drinks</a></li>"
			. "</ul>"
			. "</div>"
			. "</div></div>\n"
			. "<div class = 'row'><div class = 'col-md-12'>\n"
			. "<h2>Orders</h2>\n"
			. "</div></div>\n"
			. "<div class = 'row'>\n";
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
		$outputString .= "<div class = 'col-md-4'>\n"
		. "<table class = 'table'>\n"
		. "<tr><td>Customer Name</td> <td>" . $row1["name"] . "</td></tr>\n"
		. "<tr><td>Status</td>\n"
		. "<td>" . $row["status"] . " <button onclick = 'changeStatusMinus(" . $row["id"] . ", 1)' type = 'button' class = 'btn btn-default'>-</button>\n"
		. "<button onclick = 'changeStatusPlus(" . $row["id"] . ", 1)' type = 'button' class = 'btn btn-primary'>+</button></td></tr>\n"
		. "<tr><td>Table</td> <td>" . $row["table_number"] . "</td></tr>\n"
		. "<tr><td>Wait Time</td> <td>" . $elapsedTime . "</td></tr>\n"
		. "<tr><td>Drinks</td> <td><button onclick = 'viewOrderedDrinks(" . $row["id"] . ")' type = 'button' class = 'btn btn-primary'>View</button></td></tr>\n"
		. "<tr><td>Action</td> <td><button onclick = 'deleteOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-primary'>Delete</button>\n"
		. "<button onclick = 'finishOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-success'>Finish</button></td></tr>\n"
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