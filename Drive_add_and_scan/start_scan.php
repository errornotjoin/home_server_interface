<?php
include "database/sql_login.php";
include "outside_links.php";
#this is where fontawasome kit is stored you will need to create your own kit and create outside_links.php to use it
session_start();
if(!isset($_SESSION['username']) or !isset($_SESSION['ID']) or !isset($_SESSION['Level'])){
    header("Location: index.php?error=Not_logged_in");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../css/Only_background.css">
    <title>add Drive -- Home Server Interface</title>
</head>
<body>
    <header>
    <h2>Home Server Interface</h2>
    <h2>Drives information</h2>
    <div class="icons">
        <a title="HOME" href="home.php"> <i class="fa-solid fa-house fa-2xl"></i></a>
        <a title="Account" href="account.php"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
        <a title="Settings" href="settings.php"> <i class="fa-solid fa-gear fa-2xl"></i></a>
        <a title="Logout" href="index.php"><i class="fa-solid fa-arrow-right-from-bracket fa-2xl"></i></a>
    </div>
    </header>
    <?php
    echo $fontawasome;
    ?>
    <main>
    <section class="add_drive_section">
        <section>
            <select>

            </select>
            <select></select>
            <input type="submit" value="Scan Drive">
        </section>
    
        

    </main>
        <footer>
        <p><i class="fa-solid fa-circle-info" style="color: rgba(0, 0, 0, 1.00);"></i> This site uses Font Awesome. Their CDN may receive your IP address, but no personal data or tracking cookies are used.</p>
</p>
    </footer>
    
</body>
</html>