<?php
include "../database/sql_login.php";
include "../outside_links.php";
echo $fontawasome;
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
    <link rel="stylesheet" href="../css/drive_infor.css">
    <title>Document</title>
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
    <main>
        <section>
            <section class="drive_infor">
                <h2 class='drive_infor_storage'> <i class="fa-solid fa-hard-drive"></i> <?php echo $_SESSION['drive_name']; ?> </h2>
                <input class="Drive_Path" readonly value="<?php echo $_GET['Paths']?>">

            </section>
        </section>
        <section>
    
            <div class="Drive_folders_holder">
                <ul>
                <?php
                $count = substr_count($_GET['Paths'], "/");
                if($count > 1)
                    {
                        echo "<li>";
                        echo "<a href='folder_info.php?Paths=".$_GET['Paths']."' class='folder_link'> ";
                            echo "<section>";
                                echo "<i title='folders' class=\"fa-solid fa-arrow-left fa-2xl\" ></i>";
                                echo "<h1> Go Back </h1>";
                                echo "<p> ". $_GET['Paths'] ." </p>";
                            echo "</section>";
                    }
                    else if($count <= 2)
                        {
                            echo "<li>";
                            echo "<a href='drive_info.php?ID=". $_SESSION['drive_ID']."' class='folder_link'> ";
                                echo "<section>";
                                    echo "<i title='folders' class=\"fa-solid fa-arrow-left fa-2xl\" ></i>";
                                    echo "<h1> Go Back </h1>";
                                    echo "<p> ". $_GET['Paths'] ." </p>";
                                echo "</section>";

                        }
                    
    
                $new_drive_name = str_replace("//", "%", $_GET['Paths']);
                #print(  $new_drive_name. "/");
                $sql_code = "SELECT * FROM folders WHERE Paths LIKE '". $new_drive_name. "%'";
                $result = mysqli_query($connection, $sql_code);
                while($row = mysqli_fetch_array($result)){
                    $start = substr($row['Paths'], strlen($new_drive_name));
                    if(substr_count($start, '/') < 2 and strlen($new_drive_name) == strlen($row['Paths']) - strlen($start) and $row['Paths'] != $_GET['Paths']){ 
                    echo "<li>";
                    echo "<a href='folder_info.php?Paths=". $row['Paths'] ."' class='folder_link'>";
                        echo "<section>";
                            echo "<i title='folders' class=\"fa-solid fa-folder fa-2xl\" ></i>";
                            echo "<h1>  ". $row['folders_Name'] ." </h1>";
                            echo "<p> ". $row['Paths'] ." </p>";
                            echo "<p> ". $row['folder_size'] ." </p>";
                        echo "</section>";
                    echo "</a>";
                    echo "</li>";
                    }
                    else
                        {
                            continue;
                        }
                    
                }
                $sql_code = "SELECT * FROM files WHERE file_paths like '". $new_drive_name. "%' limit 150"; 
                $result = mysqli_query($connection, $sql_code);
                while($row = mysqli_fetch_array($result)){ 
                    
                    $counts = explode("/", $row['file_paths']);
                    $start = substr($row['file_paths'], strlen($new_drive_name));
                    
                    #print($start);
    
                    if(substr_count($start, '/') < 2 and strlen($new_drive_name) == strlen($row['file_paths']) - strlen($start) ){ 
                        echo "<li>";
                        echo "<a href='view_files.php?file=". $row['file_paths'] ."'  class='folder_link'>";
                            echo "<section>";
                                echo "<i title='". $row['file_extension'] ." file' class=\"fa-solid fa-file fa-2xl\" ></i>";
                                echo "<h1>  ". $row['file_name'] ." </h1>";
                                echo "<p> ". $row['file_paths'] ." </p>";
                                echo "<p> ". $row['file_size'] ." </p>";
                            echo "</section>";
                        echo "</a>";
                        echo "</li>";
                    }
                    
    
                    
                }
                
                
                
                ?>
                </ul>
            </div>
        </section>
    </main>
    <footer>
        <p><i class="fa-solid fa-circle-info" style="color: rgba(0, 0, 0, 1.00);"></i> This site uses Font Awesome. Their CDN may receive your IP address, but no personal data or tracking cookies are used.</p>
</p>
    </footer>
    
</body>
</html>