<?php
	require 'connect.php';
	$cxn = connect();
	$response = array();
	
	$response['POST'] = json_encode($_POST);
	$response['user'] = $user = (int)$_POST["user_id"];
	$response['venue'] = $venue = (int)$_POST["venue_id"];
	
	if(isset($_POST["table_num"]))
		$response['table'] = $table = (int)$_POST["table_num"];
	else
		$response['table'] = $table = 0;
	
	if($user && $venue)
	{		
		$query = mysql_query("insert into tab(customer_id, venue_id, table_number) values($user, $venue, $table)");
		$query = mysql_query("select * from tab where start_time = (select max(start_time) from tab where customer_id = $user and venue_id = $venue and table_number = $table)");		
		if($query)
		{
			$index = 0;
			$row = mysql_fetch_row($query);
			$response['row_data'] = $row;
			$tab_id = (int)$row[0];
			while(true)
			{
				if(isset($_POST["drinks".$index]))
				{
					$drink = (int)$_POST["drinks".$index++];
					$query = mysql_query("insert into tab_drinks(tab_id, drink_id) values($tab_id, $drink)");
					if($query){continue;}
					else
					{
						$response['error'] = mysql_error();
						break;
					}
				}
				else{break;}
			}
			$response['success'] = true;
			$response['message'] = "Order placed";
			$response['order_num'] = $tab_id;
		}
		else
		{
			$response['success'] = false;
			$response['message'] = mysql_error();
		}
	}
	else
	{
		$response['success'] = false;
		$response['message'] = "Data not filled in.";
	}
	
	echo json_encode($response);
?>