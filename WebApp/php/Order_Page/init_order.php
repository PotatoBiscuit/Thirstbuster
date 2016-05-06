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

$queryString = "SELECT * FROM `tab` WHERE venue_id = '" . $_SESSION["ID"] . "' AND status <> 'Complete' ORDER BY start_time ASC";
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
		
		if($currentTime["minutes"] - $orderTime[1] >= 10 || $currentTime["hours"] - $orderTime[0] >= 1){
			$warningState = "table-danger";
		}
		else if($currentTime["minutes"] - $orderTime[1] >= 5){
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
			$statusOrdered = "Checked";
			$statusFilling = "";
			$statusDelivering = "";
		}
		else if($row["status"] == "Filling"){
			$statusOrdered = "";
			$statusFilling = "Checked";
			$statusDelivering = "";
		}
		else if($row["status"] == "Delivering"){
			$statusOrdered = "";
			$statusFilling = "";
			$statusDelivering = "Checked";
		}
		else{
			$statusOrdered = "Checked";
			$statusFilling = "";
			$statusDelivering = "";
		}
		
		$outputString .= "<div class = 'col-md-6'>\n"
		. "<table id = 'order_table' class = 'table table-striped'>\n"
		. "<thead class='thead-inverse'><tr><th>Customer Name</th> <th>" . $row1["name"] . "</th></tr></thead>\n"
		. "<tbody><tr><td>Status</td>\n"
		. "<td>"
		. "<div id='order_status" . $row["id"] . "' class='segmented-control' style='width: 100%; color: #385bad'>"
		. "<input type='radio' name='sc-1-" . $row["id"] . "' id='sc-1-" . $row["id"] . "-1' value='Ordered' " . $statusOrdered . ">"
		. "<input type='radio' name='sc-1-" . $row["id"] . "' id='sc-1-" . $row["id"] . "-2' value='Filling' " . $statusFilling . ">"
		. "<input type='radio' name='sc-1-" . $row["id"] . "' id='sc-1-" . $row["id"] . "-3' value='Delivering' " . $statusDelivering . ">"
		. "<label onclick='changeOrderStatus(" . $row["id"] . ", 1, \"Ordered\")' for='sc-1-" . $row["id"] . "-1' data-value='Ordered'>Ordered</label>"
		. "<label onclick='changeOrderStatus(" . $row["id"] . ", 1, \"Filling\")' for='sc-1-" . $row["id"] . "-2' data-value='Filling'>Filling</label>"
		. "<label onclick='changeOrderStatus(" . $row["id"] . ", 1, \"Delivering\")' for='sc-1-" . $row["id"] . "-3' data-value='Delivering'>Delivering</label>"
		. "</div>"



		. "</td></tr>\n"
		. "<tr><td>Table</td> <td>" . $table_number . "</td></tr>\n"
		. "<tr><td class = '" . $warningState . "'>Wait Time</td> <td class = '" . $warningState . "'>" . $elapsedTime . "</td></tr>\n"
		. "<tr><td>Drinks</td> <td><button onclick = 'viewOrderedDrinks(" . $row["id"] . ")' onkeypress = 'viewOrderedDrinks(" . $row["id"] . ")' type = 'button' class = 'btn btn-primary'>View</button></td></tr>\n"
		. "<tr><td>Action</td> <td><div class='row'><div class='col-md-4'><button onclick = 'finishOrder(" . $row["id"] . ")' onkeypress = 'finishOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-success'>Finish</button></div>"
		. "<div class='col-md-2'><div class='vertical_hr' style='height=45px;'>&nbsp;</div></div>"
		. "<div class='col-md-4'><button onclick = 'deleteOrder(" . $row["id"] . ")' onkeypress = 'deleteOrder(" . $row["id"] . ")' type = 'button' class = 'btn btn-danger'>Delete</button></div></div></td></tr>"
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