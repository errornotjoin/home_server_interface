<?php
include "outside_links.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/background.css">
    <?php
    echo $fontawasome;
    ?>
    <title>Login -- Home Server Interface</title>
</head>
<body>
<header>
    <h2>Home Server Interface</h2>
    <h2 class="middle_child_of_header" style="text-align:center">Drives information</h2>
    <div class="icons">
       
    </div>
    </header>

    <form action="database/decrpty.php" method="post" class="Login_form">
        <div class="user_input">
            <h2 for="username"><i class="fa-solid fa-address-card" style="color: snow;"></i><u>Username </u></h2>
            <input type="text" id="username" name="username" required><br><br>
        </div>
        <div class="user_input">
            <h2 for="password"><i class="fa-solid fa-key" style="color:snow;"></i><u>Password </u> </h2>
            <input type="password" id="password" name="password" required><br><br>
        </div>
        <div class="Other_inputs">
            <div>
                <button type="reset" class="custom_button"> <h2><i class="fa-solid fa-arrow-rotate-left fa-lg"></i></h2> <h3><u>Reset </u></h3></button>
                <button type="submit" class="custom_button"><h2><i class="fa-solid fa-right-to-bracket fa-lg"> </i></h2> <h3><u>log in</u></h3></button>
            </div>
            <div class="other_other">
            <a href="create_account.php">Don't have an account? Create an account</a>
            </div>
        </div>
    </form>
        <footer>
        <p>
            <i class="fa-solid fa-circle-info fa-2xl" style="color: rgba(0, 0, 0, 1.00);"></i> 
            This site uses Font Awesome. Their CDN may receive your IP address, but no personal data or tracking cookies are used.</p>
        </p>
    </footer>
    
</body>
</html>