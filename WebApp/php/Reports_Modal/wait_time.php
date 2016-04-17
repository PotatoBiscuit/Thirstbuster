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

$queryString = "SELECT start_time, delivery_time FROM tab "
. "INNER JOIN tab_drinks ON tab.id = tab_drinks.tab_id "
. "WHERE tab.status = 'Complete'";

$result = $conn->query($queryString);

$start_times = array();
$lengths = array();

if ($result->num_rows == 0){
	echo $outputString;
	exit();
}
else {
	while($row = $result->fetch_assoc()){

		if(!in_array($row["start_time"], $start_times)) {
			array_push($start_times, $row["start_time"]);
		}
		if(!isset($lengths[$row["start_time"]])) {
			$lengths[$row["start_time"]] = array();
			array_push($lengths[$row["start_time"]], 1);
			array_push($lengths[$row["start_time"]], $row["delivery_time"]);
		} else {
			$lengths[$row["start_time"]][0]++;
		}

	}
}

$outputString = "";

$outputString .= "<script type='text/javascript'>"
. "var chartData = getChartData();"
. "var chart = AmCharts.makeChart(\"chartdiv\", {"
. "\"type\":\"serial\",\"theme\":\"none\",\"marginRight\":80,\"dataProvider\":chartData";
/*
for ($i = 0; $i < count($lengths); $i++) {
	$outputString .= "\"date\":\"" . $lengths[$start_times[$i]][1] . "\",\"items\":\"" . $lengths[$start_times[$i]][0] . "\"}";
	if(($i + 1) != count($lengths)) {
		$outputString .= ",{";
	}
}
*/
$outputString .= ",\"valueAxes\":[{\"position\":\"left\",\"title\":\"items in order\"}],"
. "\"graphs\":[{\"id\":\"g1\",\"fillAlphas\":0.4,\"valueField\":\"items\",\"balloonText\":\"<div style='margin:5px; font-size:19px;'>Items:<b>[[value]]</b></div>\""
. "}],\"chartScrollbar\":{\"graph\":\"g1\",\"scrollbarHeight\":50,\"backgroundAlpha\":0,\"selectedBackgroundAlpha\":0.1,\"selectedBackgroundColor\":\"#888888\","
. "\"graphFillAlpha\":0,\"graphLineAlpha\":0.5,\"selectedGraphFillAlpha\":0,\"selectedGraphLineAlpha\":1,\"autoGridCount\":true,\"color\":\"#AAAAAA\"},"
. "\"chartCursor\":{\"categoryBalloonDateFormat\":\"JJ:NN, DD MMMM\",\"cursorPosition\":\"mouse\"},\"categoryField\":\"date\",\"categoryAxis\":{\"minPeriod\":\"SS\","
. "\"parseDates\":true},\"export\":{\"enabled\":true,\"dateFormat\":\"YYYY-MM-DD HH:NN:SS\"}});";

$outputString .= "function getChartData() {"
. "var chartData = [];";
for ($i = 0; $i < count($lengths); $i++) {
	$outputString .= "var startDate = convertDateTime";
}

$outputString .= "</script><div id='chartdiv'></div>";

echo $outputString;
?>