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

$queryString = "SELECT * FROM `tab` WHERE venue_id = '" . $_SESSION["ID"] . "' AND status <> 'Complete' ORDER BY start_time DESC";
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
		
		if($currentTime["hours"] - $orderTime[0] >= 1){
			$warningState = "table-danger";
		}
		else if($currentTime["minutes"] - $orderTime[1] >= 30){
			$warningState = "table-caution";
		}
		else{
			$warningState = "table-success";
		}
		
		$elapsedMinutes = $currentTime["minutes"] - $orderTime[1];
		$elapsedSeconds = $currentTime["seconds"] - $orderTime[2];
		if($elapsedMinutes < 10){
			$elapsedMinutes = "0" . $elapsedMinutes;
		}
		if($elapsedSeconds < 10){
			$elapsedSeconds = "0" . $elapsedSeconds;
		}
		
		$elapsedTime = ($currentTime["hours"] - $orderTime[0]) . ":"
		. $elapsedMinutes . ":"
		. $elapsedSeconds;
		if($row["table_number"] == 0){
			$table_number = "Self-serve";
		}
		else{
			$table_number = $row["table_number"];
		}
		
		if($row["status"] == "Ordered"){
			$percentage = "0%";
		}
		else if($row["status"] == "Filling"){
			$percentage = "50%";
		}
		else if($row["status"] == "Delivering"){
			$percentage = "100%";
		}
		else{
			$percentage = "0%";
		}
		
		$outputString .= "<div class = 'col-md-4'>\n"
		. "<table id = 'order_table' class = 'table table-striped'>\n"
		. "<thead class='thead-inverse'><tr><th>Customer Name</th> <th>" . $row1["name"] . "</th></tr></thead>\n"
		. "<tbody><tr><td>Status</td>\n"
		. "<td>" . $row["status"] . " <button onclick = 'changeStatusMinus(" . $row["id"] . ", 1)' onkeypress = 'changeStatusMinus(" . $row["id"] . ", 1)' type = 'button' class = 'btn btn-default'>-</button>\n"
		. "<button onclick = 'changeStatusPlus(" . $row["id"] . ", 1)' onkeypress = 'changeStatusPlus(" . $row["id"] . ", 1)' type = 'button' class = 'btn btn-primary'>+</button>"
		. "<br><br><div class = 'progress'><div class = 'progress-bar' role = 'progressbar' aria-valuemin='0' aria-valuemax='100' style='width:" . $percentage . "'>"
		. "</div></div></td></tr>\n"
		. "<tr><td>Table</td> <td>" . $table_number . "</td></tr>\n"
		. "<tr><td class = '" . $warningState . "'>Wait Time</td> <td class = '" . $warningState . "'>" . $elapsedTime . "</td></tr>\n"
		. "<tr><td>Drinks</td> <td><button onclick = 'viewOrderedDrinks(" . $row["id"] . ")' onkeypress = 'viewOrderedDrinks(" . $row["id"] . ")' type = 'button' class = 'btn btn-primary'>View</button></td></tr>\n"
		. "<tr><td>Action</td> <td><button onclick = 'deleteOrder(" . $row["id"] . ")' onkeypress = 'deleteOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-primary'>Delete</button>\n"
		. "<button onclick = 'finishOrder(" . $row["id"] . ")' onkeypress = 'finishOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-success'>Finish</button></td></tr>\n"
		. "</tbody></table>\n"
		. "</div>\n";
	}
}
else{
	$outputString .= "No results to display";
}

$outputString .= "</div>\n";
echo $outputString;

?>