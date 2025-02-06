<?php
session_start(); // Starta sessionen

if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"]))
{
    $target_dir = "pictures/"; // Målmapp för uppladdade filer
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]); // Fullständig sökväg till målfilen
    $uploadOk = 1; // Variabel för att kontrollera om uppladdningen är OK
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION)); // Filtyp

    // Kontrollera om bildfilen är en faktisk bild eller en falsk bild
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        print("Filen är ett foto - " . $check["mime"] . ".");
        $uploadOk = 1; // Uppladdningen är OK
    }
    else
    {
        print("Filen är inte ett foto.");
        $uploadOk = 0; // Uppladdningen är inte OK
    }

    // Kontrollera om filen redan existerar
    if (file_exists($target_file)) 
    {
        print("OBS! Denna filen existerar redan.");
        $uploadOk = 0; // Uppladdningen är inte OK
    }

    // Kontrollera filstorleken (500 000 B, eller 500 kB)
    if ($_FILES["fileToUpload"]["size"] > 500000)
    {
        print("OBS! Din fil är för stor.");
        $uploadOk = 0; // Uppladdningen är inte OK
    }

    // Tillåt endast vissa filtyper
    if(!in_array($imageFileType, ['jpg','png']))
    {
        print("OBS! Endast JPG- & PNG- är tillåtna.");
        $uploadOk = 0; // Uppladdningen är inte OK
    }

    // Kontrollera om uppladdningen är OK
    if($uploadOk == 1)
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
        $_SESSION['upload_message'] = "Filen ".basename($_FILES["fileToUpload"]["name"]). " har laddats upp."; // Meddelande om uppladdningen lyckades
        $_SESSION['uploaded_image'] = basename($_FILES["fileToUpload"]["name"]);
    }
    else
    {
        $_SESSION['upload_message'] = "OBS! Det uppstod ett fel under uppladdningen av din fil."; // Meddelande om fel vid uppladdningen
    }
}
else
{
    $_SESSION['upload_message'] = "Ingen fil uppladdades eller skickades."; // Meddelande om ingen fil uppladdades eller skickades
}

?>

