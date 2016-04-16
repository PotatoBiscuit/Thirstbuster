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

$queryString = "SELECT * FROM tab "
. "INNER JOIN tab_drinks ON tab.id = tab_drinks.tab_id "
. "WHERE tab.status = 'Complete'";

$result = $conn->query($queryString);
$num_drinks_sold = $result->num_rows;

$outputString = "<button class='btn btn-primary dropdown-toggle' type='button' data-toggle='dropdown'>Select Report"
. "<span class='caret'></span></button>"
. "<ul class='dropdown-menu'>"
. "<li><a onclick='initDisplay(1)' href='#'>Total Drinks Sold</a></li>"
. "<li><a onclick='initDisplay(2)' href='#'>Ave. Wait Time</a></li>"
. "<li><a onclick='initDisplay(3)' href='#'>Total Sales</a></li>"
. "</ul><br><br>"
. "<b>Number of Drinks Sold: </b>" . $num_drinks_sold;

$list_of_drinks = array();

if ($result->num_rows == 0){
	echo $outputString;
	exit();
}
else {
	while($row = $result->fetch_assoc()){
		array_push($list_of_drinks, $row["drink_id"]);
	}
}

$queryString = "SELECT id, name FROM drink";
$result = $conn->query($queryString);

$drinkCount = array();
if ($result->num_rows == 0){
	echo $outputString;
	exit();
}
else{
	while($row = $result->fetch_assoc()){
		array_push($drinkCount, array($row["id"], $row["name"], 0));
	}
}

for($i = 0; $i < count($list_of_drinks); $i++){
	for($j = 0; $j < count($drinkCount); $j++){
		if($list_of_drinks[$i] == $drinkCount[$j][0]){
			$drinkCount[$j][2] = 1 + $drinkCount[$j][2];
		}
	}
}

$outputString .= "<br><br><table>";

for ($i = 0; $i < count($drinkCount); $i++){
	$outputString .= "<tr><td><b>" . $drinkCount[$i][1] . "</b></td><td>" . $drinkCount[$i][2] . "</td></tr>";
}
$outputString .= "</table>";



echo $outputString;
?>



