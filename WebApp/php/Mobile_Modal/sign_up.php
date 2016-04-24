<?php

	require 'connect.php';
	$cxn = connect();
	$response = array();
	
	$name= $_POST["name"];
	$username = $_POST["username"];
	$password = $_POST["password"];
	$credit = $_POST["credit"];
	
	$response['POST'] = json_encode($_POST);
	$response['name'] = $name;
	$response['username'] = $username;
	$response['password'] = $password;
	$response['credit'] = $credit;
	
	if($name && $username && $password && $credit)
	{
		$query = mysql_query("insert into customer(name, username, password, credit) values('$name', '$username',  '$password', '$credit')");
		if($query)
		{
			$response['success'] = true;
			$response['message'] = 'Sign up successful';
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
		$response['message'] = 'Data not filled.';
	}
	
	echo json_encode($response);
?>