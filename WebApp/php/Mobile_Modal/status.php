<?php
	require 'connect.php';
	$cxn = connect();
	$response = array();
	
	$response['POST'] = json_encode($_POST);
	$response['id'] = $id = (int)$_POST["id"];
	$response['venue_id'] = $venue_id = (int)$_POST["venue_id"];
	$response['customer_id'] = $customer_id = (int)$_POST["customer_id"];
	
	$query = mysql_query("select * from tab where id = $id and customer_id = $customer_id and venue_id = $venue_id");
	if($query)
	{
		$response['message'] = "Got status";
		$response['data'] = mysql_fetch_assoc($query);
	}
	else
	{
		$response['message'] = "Failed to update status";
	}
	
	echo json_encode($response);
?>