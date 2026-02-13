<?php
include "sql_login.php";
session_start();
$User_enter_name = $_POST['username'];
$user_enter_password = $_POST['password'];
$sql_code = "SELECT * FROM `accounts` ";
$result = mysqli_query($connection, $sql_code);

while ($row = mysqli_fetch_assoc($result)) {

    $username = $row['Username'];
    $password = $row['Password'];

    $cheack_password = password_verify($user_enter_password, $password);

    if($cheack_password == true and $username == $_POST['username']){

        $_SESSION['username'] = $username;
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['Level'] = $row['Level'];

        header("Location: ../home.php");
        exit();
    }
    else{
        header("Location: ../index.php?error=wrong_password_or_username");
        exit();
    }
}


