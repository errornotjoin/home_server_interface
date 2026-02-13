<?php
include "database/sql_login.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $sql_code =  "SELECT * FROM login_page";
        $sql_query = mysqli_query( $connection, $sql_code); 
        while($row = mysqli_fetch_array($sql_query))
        {
            if($row['Is_Create_account_allowed'] == 1) 
            { 
                echo "<form action='database/encrpty.php' method='post'>";
                    echo "<h2> create username </h2>";
                    echo "<input type='text' name='username' placeholder='create username' required minlength='5'>";
                    echo "<h2> create password </h2>";
                    echo "<input type='text' name='password' onchange='' placeholder='create password' required minlength='10' id='always_true_password'>";
                    echo "<input type='password' name='verf_password' placeholder='verf passoword' minlength id='verf_Password'";
                    echo "<div>";
                        echo "<input type='reset' value='reset'>";
                        echo "<input type='submit' value='create account'>"; 
                    echo "</div>";
                echo "</form>";
            } 
            else
            { 
                echo "<h1> account creation is not allowed </h1>";
                echo "<p> Contact the owner/admin to open up account creation, closed from: ". $row['when_made'] ."</p>";
                echo "<a href='index.php'> back to login page </a>";
            }

        }
    ?>
        
    
</body>
</html>