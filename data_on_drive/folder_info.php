<?php
include "../database/sql_login.php";
include "../outside_links.php";

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/background.css">
    <link rel="stylesheet" href="../css/drive_infor.css">
    <?php
    echo $fontawasome;
    ?>
    <title>Folders -- Home Server Interface</title>
</head>
<body>
    <header>
        <h2>Home Server Interface</h2>
        <h2 class="middle_child_of_header" style="text-align:center">Folders information</h2>
        <div class="icons">
            <a title="HOME" href="../home.php"> <i class="fa-solid fa-house fa-2xl"></i></a>
            <a title="Scan Drives" href="../Drive_add_and_scan/start_scan.php"><i class="fa-solid fa-arrows-spin fa-2xl" ></i></a>
            <a title="Account" href="../account_items/account.php"><i class="fa-solid fa-circle-user fa-2xl"></i></a>
            <a title="Settings" href="../account_items/settings.php"> <i class="fa-solid fa-gear fa-2xl"></i></a>
            <a title="Logout" href="../index.php"><i class="fa-solid fa-arrow-right-from-bracket fa-2xl"></i></a>
            
        </div>
    </header>
    <main>
        <?php
        $allow_go_back = true; # this is to allow the user to go back to the previous folder
        $total_folders_and_files = 0; # this see if any folders or files are found
        
        if(isset($_GET["Type_of_information"]) and $_GET["Type_of_information"] == "drive" )
        {
            unset($_SESSION['Path_history']);#the history being cleared as it get replaced with the new drive path

            $change_drive = str_replace("\\\\", "//", $_GET["drivecs_Name"]);

            $_SESSION['Path_history'] = []; # telling the system that this is the first item in the path history

            $_SESSION['Path_history'][0] = $change_drive; #the root of the drive 
            $_SESSION['Root'] = $change_drive; 
            
            $_GET["drivecs_Name"] = $change_drive;

            $root_name = $change_drive; # this is the root name of the drive, it is used to compare with the folder paths to make sure that only the folders in the drive are shown

            $allow_go_back = false; # this is to make sure that the user can not go back to the previous drive when they are in the root of the drive

        }
        #make sure that if the page reloads the page it dose not add it back 
        else if(end($_SESSION['Path_history']) != $_GET["drivecs_Name"] )
        {
            if(isset($_GET["Add_to_history"]) and $_GET["Add_to_history"] != "true" )
            {
                #remove the current folder from the path history if the user is going back to the previous folder, it removes the current folder from the path history so that the user can go back to it again if they want to
                $_SESSION['Path_history'] = array_slice($_SESSION['Path_history'], 0, count($_SESSION['Path_history']) - 1); # this is to remove the current folder from the path history if the user is going back to the previous folder, it removes the current folder from the path history so that the user can go back to it again if they want to
            }
            else
            {
                # add items to user path history 
                # to allow the user to go back to previous folders
                $_SESSION['Path_history'][] = $_GET["drivecs_Name"];
            }
        }
        #idk if i going to keep it,
        #but right i'm using as testing the $_SESSION['Path_history'] to see if it works as intended
        echo "<aside class='path_history'>"; # this is the path history section
            echo "<div class='path_history_header'>";
                echo "<i class='fa-solid fa-timeline fa-xl'></i>";
                echo "<h3>Path history</h3>";
            echo "</div>";
            echo "<div class='path_history_items' id='path_history_items_hide_show'>";
                echo "<ul>";
                foreach($_SESSION['Path_history'] as $item)
                {
                    #if($item == $_GET["drivecs_Name"])
                    #{
                    #    echo "<li><a href='?drivecs_Name=" . $item . "&Type_of_information=drive'>" . htmlspecialchars($item) . "</a></li>";
                    #}
                    #else
                    #{
                        echo "<li><a href='?drivecs_Name=" . $item . "'>" . htmlspecialchars($item) . "</a></li>";
                    #}
                }
                echo "</ul>";
            echo "</div>";
        echo "</aside>";
        echo "<section class='folders_and_files'>"; # this is the section that contains the folders and files information
        if($_GET["drivecs_Name"] != $_SESSION['Root'] ) # this is to show the go back button if the user is not in the root of the drive
        {
            echo "<a href='?drivecs_Name=" . $_SESSION['Path_history'][count($_SESSION['Path_history']) - 2] . "&Add_to_history=false'>"; # this is to go back to the previous folder, it gets the previous item in the path history
                echo "<section class='drives'>";
                echo "<div class='folder_info'>";
                    echo "<h2><i class='fa-solid fa-arrow-left fa-2xl'></i></h2>";
                    echo "<h2>Go back</h2>";
                echo "</div>";
                echo "<div class='folder_path_info'>";
                    echo "<h2>" . htmlspecialchars($_SESSION['Path_history'][count($_SESSION['Path_history']) - 2]) . "</h2>";
                echo "</div>";
                echo "</section>";
            echo "</a>";
        }


        $sql_code = "SELECT * FROM `folders` WHERE `Paths` like '" . $_GET["drivecs_Name"] . "%'";
        $result = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($result) > 0 ) # this is to make sure that only the root folders of the drive are shown
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if(substr_count($row["Paths"], "/")  != substr_count($_GET["drivecs_Name"], "/") )
                {
                    continue; # this is to make sure that only the root folders of the drive are shown
                }
                echo "<a href='?Type_of_information=folder&drivecs_Name=" . $row["Paths"] . "/'>";
                    echo "<section class='drives'>";
                        echo "<div class='folder_info'>";
                            echo "<h2> <i class='fa-solid fa-folder fa-2xl'></i> </h2>";
                            echo "<h2>" . htmlspecialchars($row["folders_Name"]) . "</h2>";
                            echo "<h3>Size: " . htmlspecialchars($row["folder_size"]) . " </h3>";
                            echo "<h3>Last modified: " . htmlspecialchars($row["Modified_dates"]) . "</h3>";
                        echo "</div>";
                        echo "<div class='folder_path_info'>";
                        echo "<h2>" . htmlspecialchars($row["Paths"]) . "</h2>";
                        echo "</div>";
                    echo "</section>";
                echo "</a>";
                $total_folders_and_files += 1;
            }

        }
        else
        {
            
        }
        $sql_code = "SELECT * FROM `files` WHERE `file_paths` like '" . $_GET["drivecs_Name"] . "%'";
        $result = mysqli_query($connection, $sql_code);
        if(mysqli_num_rows($result) > 0 ) # this is to make sure that only the root folders of the drive are shown
        {
            while($row = mysqli_fetch_assoc($result))
            {
                if(substr_count($row["file_paths"], "/")  != substr_count($_GET["drivecs_Name"], "/") )
                {
                    continue; # this is to make sure that only the root folders of the drive are shown
                }
                echo "<a href='?Type_of_information=folder&drivecs_Name=" . $row["file_paths"] . "/'>";
                    echo "<section class='drives'>";
                        echo "<div class='folder_info'>";
                            echo "<h2> <i class='fa-solid fa-file fa-2xl'></i> </h2>";
                            echo "<h2>" . htmlspecialchars($row["file_name"]) . "</h2>";
                            echo "<h3>Size: " . htmlspecialchars($row["file_size"]) . " </h3>";
                            echo "<h3>Last modified: " . htmlspecialchars($row["When_updated"]) . "</h3>";
                        echo "</div>";
                        echo "<div class='folder_path_info'>";
                        echo "<h2>" . htmlspecialchars($row["file_paths"]) . "</h2>";
                        echo "</div>";
                    echo "</section>";
                echo "</a>";
                $total_folders_and_files += 1;
            }

        }
        if($total_folders_and_files == 0)
        {
            echo "<section class='drives'>";
                echo "<div class='folder_info'>";
                    echo "<h2><i class='fa-solid fa-triangle-exclamation fa-2xl'></i></h2>";
                    echo "<h2>No folders or files found in this directory</h2>";
                    echo "<h2><i class='fa-solid fa-triangle-exclamation fa-2xl'></i></h2>";
                echo "</div>";
            echo "</section>";
        }
        
        echo "</section>";









        ?>
    </main>
    <footer>
        <p>
            <i class="fa-solid fa-circle-info fa-xl" ></i> 
            This site uses Font Awesome. Their CDN may receive your IP address, but no personal data or tracking cookies are used.</p>
        </p>
    </footer>
    
</body>
</html>