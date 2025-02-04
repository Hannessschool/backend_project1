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

<<<<<<< HEAD
    // Kontrollera filstorleken (500 000 B, eller 500 kB)
    if ($_FILES["fileToUpload"]["size"] > 500000)
    {
        print("OBS! Din fil är för stor.");
        $uploadOk = 0; // Uppladdningen är inte OK
    }

    // Tillåt endast vissa filtyper
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif")
    {
        print("OBS! Endast JPG-, JPEG-, PNG- & GIF-filer är tillåtna.");
        $uploadOk = 0; // Uppladdningen är inte OK
    }

    // Kontrollera om uppladdningen är OK
=======
<<<<<<< HEAD
    // Kontrollera filstorleken (500 000 B, eller 500 kB)
    if ($_FILES["fileToUpload"]["size"] > 500000)
    {
        print("OBS! Din fil är för stor.");
=======
    if ($_FILES["fileToUpload"]["size"] > 500000)  // 500 000 B, eller 500 kB
     {
        print("OBS! Din fil är för stor.");
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" )
    {
        print("OBS! Endast JPG-, JPEG-, PNG- & GIF-files är tillåtna.");
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
        $uploadOk = 0;
    }

    // Tillåt endast JPG och PNG-filer
    if($imageFileType != "jpg" && $imageFileType != "png")
    {
        print("OBS! Endast JPG och PNG-filer är tillåtna.");
        $uploadOk = 0;
    }

    // Kontrollera om uppladdningen lyckades
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    if($uploadOk == 0)
    {
        print("Beklagar, uppladdningen lyckades inte."); // Meddelande om uppladdningen misslyckades
    }
    else
    {
        // Försök att ladda upp filen
        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
        {
            print("Filen ".basename($_FILES["fileToUpload"]["name"]). " har laddats upp."); // Meddelande om uppladdningen lyckades
        }
        else
        {
            print("OBS! Det uppstod ett fel under uppladdningen av din fil."); // Meddelande om fel vid uppladdningen
        }
    }
<<<<<<< HEAD

=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
    exit();
} 
else
{
    $_SESSION['upload_message'] = "Ingen fil uppladdades eller skickades."; // Meddelande om ingen fil uppladdades eller skickades
    exit();
}
?>
