<?php
include "../database/sql_login.php";
include "../outside_links.php";

require '../vendor/autoload.php'; 
use Symfony\Component\Yaml\Yaml;
#this is where fontawasome kit is stored you will need to create your own kit and create outside_links.php to use it
session_start();
if(!isset($_SESSION['username']) or !isset($_SESSION['ID']) or !isset($_SESSION['Level'])){
    header("Location: ../index.php?error=Not_logged_in");
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
<a title="HOME" href="../home.php"> <i class="fa-solid fa-house fa-2xl"></i></a>
        <a title="Account" href="../account_items/account.php"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
        <a title="Settings" href="../account_items\settings.php"> <i class="fa-solid fa-gear fa-2xl"></i></a>
        <a title="Logout" href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket fa-2xl"></i></a>
    </div>
    </header>
    <?php
    echo $fontawasome;
    ?>
    <main>
    <section class="add_drive_section">
        <form action="#" method="post">
            <select name="Type_of_scans">
                <?php
                $list= [];
                $Type_of_scan = array_keys($other_yml_link['types_of_scans']);
                foreach($Type_of_scan as $scan){
                    echo "<option value='". $scan ."'>". $scan ."</option>";
                }
                ?>
            </select>
            <input type="submit" value="Scan Drive">
        </form>
        <section>
            <?php
                $Type_of_scan = array_keys($other_yml_link['types_of_scans']);
                
                foreach($Type_of_scan as $scan)
                {
                    $other_scan = $other_yml_link['types_of_scans'][$scan]['booledan'];
                    
                    
                        if( $scan == $_POST['Type_of_scans'] ){
                            $other_yml_link['types_of_scans'][$scan]['booledan'] = "True";
                        }
                        else{
                            $other_yml_link['types_of_scans'][$scan]['booledan'] = "False";
                        }
                        file_put_contents($Other_paths, Yaml::dump($other_yml_link, 4, 2));
                        print_r($other_scan);
                    
                }
                $output = shell_exec( "C:\\Windows\\System32\\cmd.exe /c c:\\xampp\\htdocs\\home_server_interface\\.venv\\Scripts\\python.exe C:\\xampp\\htdocs\\home_server_information\\index.py 2>&1");    
                echo "<pre>$output</pre>";
            ?>
        
        </section>
        
    </main>
</body>
</html>