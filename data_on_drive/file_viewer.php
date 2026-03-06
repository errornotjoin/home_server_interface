<?php
include "../outside_links.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/background.css">
    <?php
    echo $fontawasome;
    ?>
    <title>Files -- Home Server Interface</title>
</head>
<body>
<header>
    <h2>Home Server Interface</h2>
    <h2 class="middle_child_of_header" style="text-align:center">Files information</h2>
    <div class="icons">
        <a title="HOME" href="../home.php"> <i class="fa-solid fa-house fa-2xl"></i></a>
        <a title="Scan Drives" href="../Drive_add_and_scan/start_scan.php"><i class="fa-solid fa-arrows-spin fa-2xl" ></i></a>
        <a title="Account" href="../account_items/account.php"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
        <a title="Settings" href="../account_items/settings.php"> <i class="fa-solid fa-gear fa-2xl"></i></a>
        <a title="Logout" href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket fa-2xl"></i></a>
        
    </div>
    </header>

    
    </form>
        <footer>
        <p>
            <i class="fa-solid fa-circle-info fa-2xl" style="color: rgba(0, 0, 0, 1.00);"></i> 
            This site uses Font Awesome. Their CDN may receive your IP address, but no personal data or tracking cookies are used.</p>
        </p>
    </footer>
    
</body>
</html>