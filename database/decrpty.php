<?php
include "sql_login.php";
session_start();
$user_enter_password = $_POST['password'];
$sql_code = "SELECT * FROM `accounts` ";
$result = mysqli_query($conn, $sql_code);

while ($row = mysqli_fetch_assoc($result)) {

    $username = $row['username'];
    $password = $row['password'];

    $cheack_password = password_verify($user_enter_password, $password);

    if($cheack_password == true and $username == $_POST['username']){

        $_SESSION['username'] = $username;
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['Level'] = $row['Level'];

        header("Location: ../home.php");
        exit();
    }
}


