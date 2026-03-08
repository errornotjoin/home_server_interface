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
        // redoing 
        // this is getting more confusing so i will redo it later
        <?php
            if($_GET["Type_of_information"] == "drive" and isset($_GET['drivecs_Name']))
                 
            {
                 $_SESSION['last_folder'] = [$_GET['drivecs_Name']];
                $_SESSION['Last_type_of_information'] = "drive";
                $change_name = str_replace("\\\\", "//", $_GET['drivecs_Name']);
                $sql_code = "SELECT * FROM `folders` WHERE Paths LIKE '". $change_name ."%' ORDER BY ID DESC";
                $result = mysqli_query($connection, $sql_code);
                while($row = mysqli_fetch_array($result)){
                    if(substr_count($row['Paths'], "/") == 2){
                       echo "<a href='folder_info.php?drivecs_Name=". $row['Paths'] ."&Type_of_information=folder'>";
                            echo "<section title='View: ". $row['folders_Name'] ." Files' class='drives'>";
                                echo "<div class='folder_info'>
                                <h2 title='Folder Icon (from fontawason)'><i class=\"fa-solid fa-folder fa-xl\"> </i></h2>
                                <h1 title='Folder Name'><u class='middle_child_of_text'>". $row['folders_Name'] ."</u></h1>
                                <h3 title='Folder Size'>". $row['folder_size'] ."</h3>
                                <h3 title='Modified Date'>". $row['Modified_dates'] ." </h3>
                                </div>";
                            echo "<div class='folder_path_info'>";
                            echo "<h2 title='Folder Path: ". $row['Paths'] ."'>";
                            echo $row['Paths'];
                            echo "</h2>";
                            echo "</div>";
                            echo "</section>";
                        echo "</a>";}
                }
                 $sql_code = "SELECT * FROM `files` WHERE file_paths LIKE '". $change_name ."%' ORDER BY ID DESC";
                $result = mysqli_query($connection, $sql_code);
                while($row = mysqli_fetch_array($result)){
                    if(substr_count($row['file_paths'], "/") == 2){
                    echo "<a href='file_viewer.php?drivecs_Name=". $row['file_paths'] ."&Type_of_information=file'>";
                       echo "<section title='File Name: ". $row['file_name'] ." | File Size: ". $row['file_size'] ." | Modified Date: ". $row['When_updated'] ."' class='drives'>";
                            echo "<div class='folder_info'>
                            <h2 title='File Icon (from fontawason)'><i class=\"fa-solid fa-file fa-xl\"> </i></h2>
                            <h1 title='File Name'><u class='middle_child_of_text'>". $row['file_name'] ."</u></h1>
                            <h3 title='File Size'>". $row['file_size'] ."</h3>
                            <h3 title='Modified Date'>". $row['When_updated'] ." </h3>
                            </div>";
                            echo "<div class='folder_path_info'>";
                            echo "<h2 title='File Path: ". $row['file_paths'] ."'>";
                            echo $row['file_paths'];
                            echo "</h2>";
                            echo "</div>";
                        echo "</section>";}
                    echo "</a>";
                }
            }
            elseif($_GET["Type_of_information"] == "folder" and isset($_GET['drivecs_Name']))
            {
                 $_SESSION['last_folder'] = [$_GET['drivecs_Name']];
                $_SESSION['Last_type_of_information'] = "folder";

                echo "<a href='folder_info.php?drivecs_Name=". $_SESSION["last_folder"][count($_SESSION["last_folder"]) - 1] ."&Type_of_information=folder'>";
                            echo "<section title='Go BACK' class='drives'>";
                                echo "<div class='folder_info'>
                                <h2 title='Folder Icon (from fontawason)'><i class=\"fa-solid fa-folder fa-xl\"> </i></h2>
                                <h1 title='Folder Name'><u class='middle_child_of_text'>Go Back</u></h1>
                                <h3 title='Folder Size'></h3>
                                <h3 title='Modified Date'> </h3>
                                </div>";
                            echo "<div class='folder_path_info'>";
                            echo "<h2 title='Folder Path: ".$_SESSION["last_folder"][count($_SESSION["last_folder"]) - 1] ."'>";
                            echo $_SESSION["last_folder"][count($_SESSION["last_folder"]) - 1];
                            echo "</h2>";
                            echo "</div>";
                            echo "</section>";
                echo "</a>";
                $total_items = 0 ;

               
                $change_name = substr_count($_GET['drivecs_Name'], "/")  + 1 ;

                $sql_code = "SELECT * FROM `folders` WHERE Paths like '". $_GET['drivecs_Name'] ."%' ORDER BY ID DESC";
                $result = mysqli_query($connection, $sql_code);
                while($row = mysqli_fetch_array($result)){
                        if(substr_count($row['Paths'], "/") == $change_name ){

                        echo "<a href='folder_info.php?drivecs_Name=". $row['Paths'] ."&Type_of_information=folder'>";
                                echo "<section title='View: ". $row['folders_Name'] ." Files' class='drives'>";
                                    echo "<div class='folder_info'>
                                    <h2 title='Folder Icon (from fontawason)'><i class=\"fa-solid fa-folder fa-xl\"> </i></h2>
                                    <h1 title='Folder Name'><u class='middle_child_of_text'>". $row['folders_Name'] ."</u></h1>
                                    <h3 title='Folder Size'>". $row['folder_size'] ."</h3>
                                    <h3 title='Modified Date'>". $row['Modified_dates'] ." </h3>
                                    </div>";
                                echo "<div class='folder_path_info'>";
                                echo "<h2 title='Folder Path: ". $row['Paths'] ."'>";
                                echo $row['Paths'];
                                echo "</h2>";
                                echo "</div>";
                                echo "</section>";
                            echo "</a>";}
                    $total_items += 1 ;
                }
                $sql_code = "SELECT * FROM `files` WHERE file_paths LIKE '". $_GET['drivecs_Name'] ."%' ORDER BY ID DESC";
                $result = mysqli_query($connection, $sql_code);
                while($row = mysqli_fetch_array($result)){
                    if(substr_count($row['file_paths'], "/") == $change_name){
                    echo "<a href='file_viewer.php?drivecs_Name=". $row['file_paths'] ."&Type_of_information=file'>";
                       echo "<section title='File Name: ". $row['file_name'] ." | File Size: ". $row['file_size'] ." | Modified Date: ". $row['When_updated'] ."' class='drives'>";
                            echo "<div class='folder_info'>
                            <h2 title='File Icon (from fontawason)'><i class=\"fa-solid fa-file fa-xl\"> </i></h2>
                            <h1 title='File Name'><u class='middle_child_of_text'>". $row['file_name'] ."</u></h1>
                            <h3 title='File Size'>". $row['file_size'] ."</h3>
                            <h3 title='Modified Date'>". $row['When_updated'] ." </h3>
                            </div>";
                            echo "<div class='folder_path_info'>";
                            echo "<h2 title='File Path: ". $row['file_paths'] ."'>";
                            echo $row['file_paths'];
                            echo "</h2>";
                            echo "</div>";
                        echo "</section>";}
                    echo "</a>";
                        $total_items += 1 ;
                }
                print(  $total_items);
                if($total_items <= 1){
                    echo "<a href='#'>";
                       echo "<section title='File Name:Empty Folder/files ' class='drives'>";
                            echo "<div class='folder_info'>
                            <h2 title='File Icon (from fontawason)'><i class=\"fa-solid fa-folder-open fa-xl\"> </i></h2>
                            <h1 title='File Name'><u class='middle_child_of_text'>this folder is empty</u></h1>
                            <h3 title='File Size'></h3>
                            <h3 title='Modified Date'></h3>
                            </div>";
                            echo "<div class='folder_path_info'>";
                            echo "<h2 title='File Path: ". $_GET['drivecs_Name'] ."'>";
                            echo $_GET['drivecs_Name'];
                            echo "</h2>";
                            echo "</div>";
                        echo "</section>";
                    echo "</a>";
                }

            }
            









        ?>
    </main>

    

    <footer>
        <p>
            <i class="fa-solid fa-circle-info fa-2xl" style="color: rgba(0, 0, 0, 1.00);"></i> 
            This site uses Font Awesome. Their CDN may receive your IP address, but no personal data or tracking cookies are used.</p>
        </p>
    </footer>
    
</body>
</html>