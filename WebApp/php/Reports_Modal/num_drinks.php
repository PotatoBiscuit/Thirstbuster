<?php
session_start();

if(!isset($_SESSION["ID"])){
	echo 'Error in num_drinks.php, no session ID';
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

$queryString = "SELECT * FROM tab "
. "INNER JOIN tab_drinks ON tab.id = tab_drinks.tab_id "
. "WHERE tab.status = 'Complete'";

$result = $conn->query($queryString);
$num_drinks_sold = $result->num_rows;
$outputString = "<b>Number of Drinks Sold: </b>" . $num_drinks_sold;



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

$outputString .= "<br><br><table><tr><th>Drink</th><th>Count</th></tr>";

for ($i = 0; $i < count($drinkCount); $i++){
	$outputString .= "<tr><td><b>" . $drinkCount[$i][1] . "</b></td><td>" . $drinkCount[$i][2] . "</td></tr>";
}
$outputString .= "</table><br /><script type='text/javascript'>"
. "var chart = AmCharts.makeChart( \"chartdiv\", {"
. "\"type\":\"pie\",\"theme\":\"none\",\"dataProvider\":[{";

for ($i = 0; $i < count($drinkCount); $i++) {
	$outputString .= "\"drink\":\"" . $drinkCount[$i][1] . "\",\"count\":\"" . $drinkCount[$i][2] . "\"}";
	if(($i + 1 ) != count($drinkCount)) {
		$outputString .= ",{";
	}
}

$outputString .= "],\"valueField\":\"count\",\"titleField\":\"drink\",\"balloon\":{\"fixedPosition\":true},\"export\": {\"enabled\":true}});"
. "</script><div id='chartdiv'>"
. "</div>";

echo $outputString;
?>



