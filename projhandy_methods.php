<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Funktion för att testa och rensa indata
function test_input($data)
{
    $data = trim($data); // Ta bort onödiga mellanslag
    $data = stripslashes($data); // Ta bort snedstreck
    $data = htmlspecialchars($data); // Konvertera specialtecken till HTML-entiteter
    return $data;
}

if (!isset($_SESSION['username'])) {
    header("Location: projlogin.php");
    exit();
}

$username = $_SESSION['username'];
$target_dir = "pictures/" . $username . "/";

// Skapa mappen om den inte finns
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {
    $errorMessages = [];
    $file_name = basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir . $file_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $uploadOk = 1;

    // Kontrollera om filen är en giltig bild
    if (!in_array($imageFileType, ['jpg', 'png'])) {
        $errorMessages[] = "Endast JPG och PNG är tillåtna.";
        $uploadOk = 0;
    }

    // Kontrollera filstorlek (max 500 KB)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $errorMessages[] = "Filen är för stor.";
        $uploadOk = 0;
    }

    // Ladda upp filen om allt är OK
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $errorMessages[] = "Filen " . htmlspecialchars($file_name) . " har laddats upp.";
        } else {
            $errorMessages[] = "Det uppstod ett fel vid uppladdningen.";
        }
    }
}

