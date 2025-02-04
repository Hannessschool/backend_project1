<?php
if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"]))
{
    $target_dir = "uploads/";
    $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kontrollera om bildfilen är en faktisk bild eller en falsk bild
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false)
    {
        print("Filen är ett foto - " . $check["mime"] . ".");
        $uploadOk = 1;
    }
    else
    {
        print("Filen är inte ett foto.");
        $uploadOk = 0;
    }

    // Kontrollera om filen redan finns
    if (file_exists($target_file)) 
    {
        print("OBS! Denna filen existerar redan.");
        $uploadOk = 0;
    }

    // Kontrollera filstorleken (500 000 B, eller 500 kB)
    if ($_FILES["fileToUpload"]["size"] > 500000)
    {
        print("OBS! Din fil är för stor.");
        $uploadOk = 0;
    }

    // Tillåt endast JPG och PNG-filer
    if($imageFileType != "jpg" && $imageFileType != "png")
    {
        print("OBS! Endast JPG och PNG-filer är tillåtna.");
        $uploadOk = 0;
    }

    // Kontrollera om uppladdningen lyckades
    if($uploadOk == 0)
    {
        print("Beklagar, uppladdningen lyckades inte.");
    }
    else
    {
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
            print("Filen ".basename($_FILES["fileToUpload"]["name"]). " har laddats upp");
        }
        else
        {
            print("OBS! Det uppstod ett fel under uppladdningen av din fil");
        }
    }

    exit();
} 
else
{
    $_SESSION['upload_message'] = "Ingen fil uppladdades eller skickades.";
    exit();
}
?>
