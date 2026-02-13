<?php
include "sql_login.php";
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

#check if there is an admin account if not make the first account admin
$sql_code = "SELECT count(*) FROM `accounts` WHERE `Level` = 'Admin'"; 
$result = mysqli_query($connection, $sql_code);
$check_for_admin = mysqli_fetch_array($result);
$admin = "user";
if($check_for_admin > 0){
    $admin = "Admin";
}
else{
    $admin = "User";
}
#hashing the password so noone can see the password in the database or understand it if they do see it

$hashed_password = password_hash($password, PASSWORD_DEFAULT);
try{
    $sql_code = "INSERT INTO `accounts` ( `username`, `password`, `Level`) VALUES ( '$username', '$hashed_password', '$admin')";
    $result = mysqli_query($connection, $sql_code);
}
catch(Exception $e){
    echo "Error: " . $e->getMessage();
}
header("Location: ../index.php");