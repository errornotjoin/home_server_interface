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
            <link rel="stylesheet" href="../css/background.css">
    <link rel="stylesheet" href="../css/start_scan.css">
    <title>add Drive -- Home Server Interface</title>
</head>
<body>
    <header>
    <h2>Home Server Interface</h2>
    <h2 class="middle_child_of_header">Drives information</h2>
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
        <form action="start_scan.php" method="GET" class="Pick_the_scan">
            <select name="Type_of_scans">
                <?php
                #empty list 
                $list= [];
                #getting the types of scans from the yml file and putting them in a list
                $Type_of_scan = array_keys($other_yml_link['types_of_scans']);
                #placing the names into options for the select tag
                foreach($Type_of_scan as $scan){
                    if(isset($_GET['Type_of_scans']) == true)
                    {
                        if($scan == $_GET['Type_of_scans'])
                        {
                            echo "<option value='". $scan ."' selected>". $scan ."</option>";
                        }
                        else
                        {
                            echo "<option value='". $scan ."'>". $scan ."</option>";
                        }
                    }
                    else
                    {
                        echo "<option value='". $scan ."'>". $scan ."</option>";
                    }
                }
                ?>
            </select>
            <input type="submit" value="Scan Drive">
        </form>
        <section class="the_out_put">
            <?php
                if(isset($_GET['Type_of_scans']))
                {
                    #regetting the items from the yml files
                    $Type_of_scan = array_keys($other_yml_link['types_of_scans']);
                    
                
                    foreach($Type_of_scan as $scan)
                    {   #getting the value of the booledan for the current scan
                        $other_scan = $other_yml_link['types_of_scans'][$scan]['booledan'];
                        
                            #checking if scan == User picked scan
                            if( $scan == $_GET['Type_of_scans'] )
                            {
                                #change the vaule to true if it is the same and false if it is not
                                $other_yml_link['types_of_scans'][$scan]['booledan'] = "True";
                            }
                            else
                            {
                                #change the vaule to false
                                $other_yml_link['types_of_scans'][$scan]['booledan'] = "False";
                            }
                            file_put_contents($Other_paths, Yaml::dump($other_yml_link, 4, 2));
                            #print_r($other_scan);
                        
                    }
                    set_time_limit(0);
                    #cd = where the python folder is e.g it will open the command prompt in that folder and then run the python executable from the venv and then run the index.py file with the -u flag to make it unbuffered so we can get the output in real time and 2>&1 is to get the error output as well
                    #the second part is this folder python executable is
                    #the last part is the python file to run and the -u is to make it unbuffered so we can get the output in real time
                    #and 2>&1 is to get the error output as well
                    $cmd = 'cd C:\xampp\htdocs\home_server_information && C:\xampp\htdocs\home_server_interface\.venv\Scripts\python.exe -u index.py 2>&1';
                    #opens a process to run the command and get the output
                    $handle = popen($cmd, "r");
                    #check if its at the end of file and if it's not then get the output and print it
                    while (!feof($handle)) {
                        #print the output of the command
                        $buffer = fgets($handle);
                        #covents it to html friendly format and prints it
                        echo "<pre><u>" . htmlspecialchars($buffer) . "</pre>";
                        #flushes the output buffer to the browser
                        ob_flush();
                        flush();
                    }
                    pclose($handle);

                }
                
            ?>
        
        </section>
        
    </main>
</body>
</html>