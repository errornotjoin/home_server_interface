<?php
require '../vendor/autoload.php'; 
use Symfony\Component\Yaml\Yaml;
include "sql_login.php";
include "../outside_links.php";
session_start();
if(!isset($_SESSION['username']) or !isset($_SESSION['ID']) or !isset($_SESSION['Level'])){
    header("Location: index.php?error=Not_logged_in");
    exit();
}
//getting the data from the form
$Type_of_add = $_POST['Type_of_add'];
$drive_name = $_POST['drive_name'];
//saying where it gose in the yml file
$driveyml_link['drives'][] = $drive_name;
//this addes the new drive to the yml file and then saves it 
file_put_contents($paht, Yaml::dump($driveyml_link, 4, 2));
if($Type_of_add == "Add And Scan"){
    header("Location: scan_drive.php?drive_name=".$drive_name);
    exit();
}
else{
    header("Location: drive_info.php?ID=". $_SESSION['drive_ID']);
    exit();
}



?>