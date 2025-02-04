<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {
    $target_dir = "pictures/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        print("Filen är ett foto - " . $check["mime"] . ".");
    } else {
        print("Filen är inte ett foto.");
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        print("OBS! Denna filen existerar redan.");
        $uploadOk = 0;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        print("OBS! Din fil är för stor.");
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png") {
        print("OBS! Endast JPG och PNG-filer är tillåtna.");
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            print("Filen ".basename($_FILES["fileToUpload"]["name"]). " har laddats upp.");
        } else {
            print("OBS! Det uppstod ett fel under uppladdningen av din fil.");
        }
    } else {
        print("Beklagar, uppladdningen lyckades inte.");
    }
}
?>