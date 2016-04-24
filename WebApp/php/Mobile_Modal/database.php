<?php
	require 'connect.php';
	$cxn = connect();
	
	$database = array();
	
	$customers = mysql_query('select * from customer where 1') or die(mysql_error());
	if($customers){$database['customers'][] = echoRows($customers);}
	
	$drinks = mysql_query('select * from drink where 1') or die(mysql_error());
	if($drinks){$database['drinks'][] = echoRows($drinks);}
	
	$tab = mysql_query('select * from tab where 1') or die(mysql_error());
	if($tab){$database['tabs'][] = echoRows($tab);}
	
	$tab_drinks = mysql_query('select * from tab_drinks where 1') or die(mysql_error());
	if($tab_drinks){$database['tab_drinks'][] = echoRows($tab_drinks);}
	
	$venue = mysql_query('select * from venue where 1') or die(mysql_error());
	if($venue){$database['venues'][] = echoRows($venue);}
	
	else
	{
		echo "Failed to call database";
	}
	
	function echoRows($query)
	{
		$rows = array();
		while($r = mysql_fetch_assoc($query))
		{	$rows[] = $r;}
		return $rows;
	}
	echo json_encode($database);
	
?>