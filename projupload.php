<?php
; // Starta sessionen

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

if (isset($_POST['save_desc'])) {
    $profile_desc = htmlspecialchars($_POST['profile_desc']);
    // Save the profile description to a file
    file_put_contents('profile_desc.txt', $profile_desc);
    $_SESSION['profile_desc_updated'] = true;
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

if (isset($_POST['profile_pic'])) {
    $selected_image = $_POST['profile_pic'];
    if ($selected_image) {
        // Save the selected image as profile picture in session
        $_SESSION['profile_pic'] = $selected_image;
    }
}

// Define the function to display all uploaded images
function display_all_uploaded_images($target_dir)
{
    if (!is_dir($target_dir)) {
        error_log("Directory $target_dir does not exist");
        print("<p>Inga bilder uppladdade ännu.</p>");
        return;
    }

    $images = array_diff(scandir($target_dir), array('..', '.'));

    // Filtrera för att bara visa bildfiler
    $image_files = array_filter($images, function ($file) use ($target_dir) {
        $image_file_type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        return in_array($image_file_type, ['jpg', 'jpeg', 'png']);
    });

    if (count($image_files) === 0) {
        print("<p>Inga bilder uppladdade ännu.</p>");
    } else {
        print("<h2>Alla uppladdade bilder</h2><div class='image-gallery'>");

        foreach ($image_files as $image) {
            $image_path = $target_dir . $image;
            $profile_pic_class = '';

            if (isset($_SESSION['profile_pic']) && $_SESSION['profile_pic'] === $image) {
                $profile_pic_class = ' profile-pic'; // Gör profilbilden mer synlig
            }

            print("<div class='image-container $profile_pic_class'>");
            print("<form action='' method='post' class='image-form'>");
            print("<input type='hidden' name='profile_pic' value='$image'>");
            print("<img src='$image_path' alt='Uppladdad bild' class='selectable-image' style='max-width: 100%; height: auto;'>");
            print("</form>");
            print("</div>");
        }
        print("</div>");
    }
}
?>

