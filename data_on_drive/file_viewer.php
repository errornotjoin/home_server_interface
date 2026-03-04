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
    <link rel="stylesheet" href="../css/file_viewer.css">
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
        <?php
        $sql_code = "SELECT * FROM `files` WHERE file_paths='". $_GET['file'] ."'";
        $result = mysqli_query($connection, $sql_code);
        while($row = mysqli_fetch_array($result)){
            switch($row['file_extension']){
                case ".txt":
                case "":
                    echo "<section class='file_viewer_header'>";
                    echo "<h2> <i class=\"fa-solid fa-file-video\"></i> ". $row['file_name'] ." </h2>"; 
                    echo "<a href='". $row['file_paths'] ."' download class='download_link'><i class=\"fa-solid fa-download\"></i> Download</a>";   
                    echo "</section>";
                    echo "<section class='file_viewer'>";
                        echo "<pre><code>". htmlspecialchars(file_get_contents($row['file_paths'])) ."</code></pre>";
                    echo "</section>";
                break;
                case ".jpg":
                case ".jpeg":
                case ".png":
                      echo "<section class='file_viewer_header'>";
                    echo "<h2> <i class=\"fa-solid fa-file-video\"></i> ". $row['file_name'] ." </h2>"; 
                    echo "<a href='". $row['file_paths'] ."' download class='download_link'><i class=\"fa-solid fa-download\"></i> Download</a>";   
                    echo "</section>";
                    echo "<section class='file_viewer'>";
                        echo "<img src='". $row['file_paths'] ."' alt='". $row['file_name'] ."'>";
                    echo "</section>";
                break;
                case ".mp4":
                case ".mkv":
                case ".avi":
                    echo "<section class='file_viewer_header'>";
                    echo "<h2> <i class=\"fa-solid fa-file-video\"></i> ". $row['file_name'] ." </h2>"; 
                    echo "<a href='". $row['file_paths'] ."' download class='download_link'><i class=\"fa-solid fa-download\"></i> Download</a>";   
                    echo "</section>";
                    echo "<section class='file_viewer'>";
                        echo "<video controls>";
                            echo "<source src='". $row['file_paths'] ."' type='video/mp4'>";
                            echo "Your browser does not support the video tag.";
                        echo "</video>";
                        echo "<section>";
                        echo "<h3>Other Video in folder:</h3>";
                        $sql_code2 = "SELECT * FROM `files` WHERE file_paths LIKE '". dirname($row['file_paths']) ."%' AND file_extension IN ('.mp4', '.mkv', '.avi')";
                        $result2 = mysqli_query($connection, $sql_code2);
                        while($row2 = mysqli_fetch_array($result2)){
                            if($row2['file_paths'] != $row['file_paths']){
                                echo "<a href='file_viewer.php?file=". $row2['file_paths'] ."' class='other_video_link'>";
                                    echo "<h4> <i class=\"fa-solid fa-file\"></i> ". $row2['file_name'] ." </h4>";
                                echo "</a>";
                            }
                        }
                    echo "</section>";
                case ".dll":
                case ".exe":
                     echo "<h2> <i class=\"fa-solid fa-file\"></i> ". $row['file_name'] ." </h2>";
                    echo "<section class='file_not_allow_view'>";
                        
                        echo "<p> File type not supported for preview. as it's encrypted or inaccessible or copyrighted drm </p>";
                    echo "</section>";
                break;
                case ".html":
                case ".css":
                    echo "<section class='file_viewer_header'>";
                    echo "<i class=\"fa-solid fa-file-code fa-2xl\"></i>";
                    echo "<h2>  ". $row['file_name'] ." </h2>"; 
                    echo "<h3>Size: ". $row['file_size'] ."  </h3>";
                    echo "<h3>When Modify: ". $row['When_updated'] ." </h3>";
                    echo "<a href='file://". $row['file_paths'] ."' download class='download_link'><i class=\"fa-solid fa-download fa-xlg\"></i> Download</a>";   
                    echo "</section>";
                    echo "<section class='file_viewer'>";
                        echo "<pre><code>". htmlspecialchars(file_get_contents($row['file_paths'])) ."</code></pre>";
                    echo "</section>";
                break;
                    default:
                     echo "<h2> <i class=\"fa-solid fa-file\"></i> ". $row['file_name'] ." </h2>";
                    echo "<section class='file_not_allow_view'>";
                        echo "<p> File type not supported for preview. .</p>";
                    echo "</section>";
                break;
                
            }
        }
        ?>


    </main>
</body>
</html>