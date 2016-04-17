<?php
    require("password.php");

    $con = mysqli_connect("mysql4.000webhost.com","a1324880_user","thirsty1","a1324880_data"); //host, username, password, database
    
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $statement = mysqli_prepare($con, "SELECT * FROM customer WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);

    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement, $colID, $colCredit, $colName, $colUsername, $colPassword);
    
    $response = array();
    $response["success"] = false;  
    
    while(mysqli_stmt_fetch($statement)){
        if (password_verify($password, $colPassword)) {
            $response["success"] = true;
            $response["credit"] = $colCredit;
            $response["name"] = $colName;
            $response["username"] = $colUsername;
            $response["password"] = $colPassword;       
        }
    }
    echo json_encode($response);
?>