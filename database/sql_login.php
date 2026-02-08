<?php

$serverName = "localhost";
$ServerDataBase = "local_server_storage";
$User_Name = "root";
$User_Password = "";
$Server_connects = mysqli_connect($serverName, $User_Name, $User_Password, $ServerDataBase);


if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} else {
    $connection = $Server_connects;
}

