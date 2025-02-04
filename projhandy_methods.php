<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start(); // Starta sessionen

// Funktion för att testa och rensa indata
function test_input($data)
{
    $data = trim($data); // Ta bort onödiga mellanslag
    $data = stripslashes($data); // Ta bort snedstreck
    $data = htmlspecialchars($data); // Konvertera specialtecken till HTML-entiteter
    return $data;
}

<<<<<<< HEAD
// Kontrollera om formuläret har skickats och om en fil har laddats upp
=======
<<<<<<< HEAD
//filuppladdning; lättast att lägga hit pga projprofiles struktur och adoptering av andra phps
=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
if(isset($_POST["submit"]) && isset($_FILES["fileToUpload"])) {
    $target_dir = "pictures/"; // Målmapp för uppladdade filer
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]); // Fullständig sökväg till målfilen
    $uploadOk = 1; // Variabel för att kontrollera om uppladdningen är OK
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION)); // Filtyp

<<<<<<< HEAD
    // Kontrollera om filen är en bild
=======
<<<<<<< HEAD
    // Kontrollera om bildfilen är en faktisk bild eller en falsk bild
=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        print("Filen är ett foto - " . $check["mime"] . "."); // Filen är en bild
    } else {
        print("Filen är inte ett foto."); // Filen är inte en bild
        $uploadOk = 0; // Uppladdningen är inte OK
    }

<<<<<<< HEAD
    // Kontrollera om filen redan existerar
=======
<<<<<<< HEAD
    // Kontrollera om filen redan finns
=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    if (file_exists($target_file)) {
        print("OBS! Denna filen existerar redan."); // Filen finns redan
        $uploadOk = 0; // Uppladdningen är inte OK
    }

<<<<<<< HEAD
    // Kontrollera filstorleken
=======
<<<<<<< HEAD
    // Kontrollera filstorleken (500 000 B, eller 500 kB)
=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        print("OBS! Din fil är för stor."); // Filen är för stor
        $uploadOk = 0; // Uppladdningen är inte OK
    }

<<<<<<< HEAD
    // Tillåt endast vissa filtyper
=======
<<<<<<< HEAD
    // Tillåt endast JPG och PNG-filer
=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    if ($imageFileType != "jpg" && $imageFileType != "png") {
        print("OBS! Endast JPG och PNG-filer är tillåtna."); // Endast JPG och PNG tillåtna
        $uploadOk = 0; // Uppladdningen är inte OK
    }

<<<<<<< HEAD
    // Kontrollera om uppladdningen är OK
=======
<<<<<<< HEAD
    // Kontrollera om uppladdningen lyckades
=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    if ($uploadOk == 1) {
        // Försök att ladda upp filen
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            print("Filen ".basename($_FILES["fileToUpload"]["name"]). " har laddats upp."); // Uppladdningen lyckades
        } else {
            print("OBS! Det uppstod ett fel under uppladdningen av din fil."); // Fel vid uppladdningen
        }
    } else {
        print("Beklagar, uppladdningen lyckades inte."); // Uppladdningen misslyckades
    }
}
<<<<<<< HEAD
?>
=======
<<<<<<< HEAD
?>
=======
?>
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
