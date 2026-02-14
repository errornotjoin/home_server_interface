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
    <link rel="stylesheet" href="css/home.css">
    <title>home -- Home Server Interface</title>
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
    <?php
    if($_SESSION['Level'] == "Admin"){
        $sql_code = "SELECT * FROM `Drivces_`";
        $result = mysqli_query($connection, $sql_code);
        while($row = mysqli_fetch_array($result)){
            echo "<a href='drive_info.php?ID=". $row['ID'] ."'>";
                echo "<section>";
                    echo "<h1> <i class=\"fa-solid fa-hard-drive\"></i> ". $row['drivecs_Name'] ." </h1>";
                    $new_drive_used = str_replace("GB", "", $row['drive_Used']);
                    $new_drive_size = str_replace("GB", "", $row['drivces_size']);
                    
                    echo "<progress value='". $new_drive_used ."' max='". $new_drive_size ."' title='".$row['drive_Used'] ." / ". $row['drivces_size'] ."'></progress>";
                    if($new_drive_used == $new_drive_size or $new_drive_used > $new_drive_size / 2 ){
                        echo "<p style='color: red;'> ". $row['drive_Used'] ." / ". $row['drivces_size'] ." <i class=\"fa-solid fa-exclamation fa-sm\"></i> </p>";
                    }
                    else{
                        echo "<p> ". $row['drive_Used'] ." / ". $row['drivces_size'] ." </p>";
                    }
                echo "</section>";
            echo "</a>";
        }
            echo "<a title='add new drive' href='add_drive.php'>";
                echo "<section>";
                    echo "<h1> + </h1>";
 
                echo "</section>";
            echo "</a>";
    }
    else{
        echo "<h1> Welcome user ". $_SESSION['username'] ."</h1>";
    }
    
    ?>
    </main>
    <footer>
        <p><i class="fa-solid fa-circle-info" style="color: rgba(0, 0, 0, 1.00);"></i> This site uses Font Awesome. Their CDN may receive your IP address, but no personal data or tracking cookies are used.</p>
</p>
    </footer>
</body>
</html>