<?php
include "outside_links.php";
include "database/sql_login.php";

session_start();
if(!isset($_SESSION['username']) or !isset($_SESSION['ID']) or !isset($_SESSION['Level'])){
    header("Location: index.php?error=Not_logged_in");
    exit();
}

    echo $fontawasome;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/background.css">
    <title>YML File Viewer -- Home Server Interface</title>
</head>
<body>
    <header>
        <h2>Home Server Interface</h2>
        <h2 class="middle_child_of_header">Home</h2>
        <div class="icons">
            <a title="HOME" href="home.php"> <i class="fa-solid fa-house fa-2xl"></i></a>
            <a title="Scan Drives" href="Drive_add_and_scan/start_scan.php"><i class="fa-solid fa-arrows-spin fa-2xl" ></i></a>
            <a title="Account" href="account_items/account.php"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
            <a title="Settings" href="account_items/settings.php"> <i class="fa-solid fa-gear fa-2xl"></i></a>
            <a title="Logout" href="index.php"><i class="fa-solid fa-arrow-right-from-bracket fa-2xl"></i></a>
        </div>
    </header>
    <main>
        
    </main>
    
</body>
</html>