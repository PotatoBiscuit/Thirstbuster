<?php
	require 'connect.php';
	connect();
	$response = array();
	
	$response['POST'] = json_encode($_POST);
	$response['venue'] = $venue = $_POST['venue'];
	
	$query = mysql_query("SELECT * FROM `tab` WHERE venue_id = $venue and table_number != 0 and table_number is not null and status != 'Complete'");
	if($query)
	{
		while($r = mysql_fetch_assoc($query))
			$response['tabs'][] = $r;
		$response['message'] = "Got drinks!";
	}
	else
	{
		$response['message'] = "Failed to get drinks";
	}
	echo json_encode($response);
?>