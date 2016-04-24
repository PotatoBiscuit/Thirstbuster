<?php
	require 'connect.php';
	$cxn = connect();
	
	$response = array();
	$response['id'] = $id = (int)$_POST['id'];
	if($id)
	{
		$query = mysql_query("select * from drink where id in (select drink_id from tab_drinks where tab_id in (select id from tab where customer_id = $id))");
		if($query)
		{
			while($r = mysql_fetch_assoc($query))
				{$response['drinks'][] = $r;}
			$response['message'] = 'Got drinks';
		}
		else
		{
			$response['message'] = 'Failed to get drinks.';
		}
	}
	else
	{
		$response['message'] = 'Data not posted';
	}
	echo json_encode($response);
?>