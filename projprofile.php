<?php
include "projhandy_methods.php"; // Inkludera hjälpfunktioner
include "projupload.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (isset($_POST['save_desc'])) {
    $profile_desc = htmlspecialchars($_POST['profile_desc']);
    // Save the profile description to a file Spara profilbeskrivningen till en fil
    if (file_put_contents('profile_desc.txt', $profile_desc) === false) {
    } else {
        $_SESSION['profile_desc_updated'] = true;
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save The Dayte</title>
    <link rel="stylesheet" href="./projstyle.css">
</head>
<body>
    <div id="container">    <!-- Max bredd 800px -->
        <?php include "projheader.php"; ?>
        <section>
            <h1>Din profil</h1>
            Profilinfo:
            <?php
            if (isset($_SESSION['username'])) {
                print("<span class='subtle-username'>". htmlspecialchars($_SESSION['username']) . "</span>");
            }
            ?>     
            <!-- Visa uppladdade bilder -->
            <form action="" method="post">
            <?php display_all_uploaded_images("pictures/" . $_SESSION['username'] . "/"); ?>
            </form>
            <?php
            if (isset($_SESSION['profile_pic'])) {
                $profile_pic = "pictures/" . $_SESSION['username'] . "/" . $_SESSION['profile_pic'];
                print("<h2>Din Profilbild</h2>");
                print("<img src='$profile_pic' alt='Profile Picture' style='width: 200px; height: auto;'>");
            }
            ?>

            <!-- Profilbeskrivningsruta som visar den -->
            <div class='profile-description-container'>
                <h2>Profilbeskrivning</h2>
                <?php
                if (file_exists("profile_desc.txt")) {
                    $profile_desc = htmlspecialchars(file_get_contents("profile_desc.txt"));
                    print("<p>" . $profile_desc . "</p>");
                } else {
                    print("<p>Ingen profilbeskrivning tillgängling ännu.</p>");
                }
                ?>
            </div>
            <h1>Redigera profil</h1>
            <h2>Ladda upp fil</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <label for="fileToUpload">Välj bild att ladda upp:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Bekräfta uppladdning" name="submit">
            </form>
            <h2>Profilbeskrivning</h2>
            <form action="" method="post" onsubmit="clearTextarea()">
                <textarea name="profile_desc" rows="4" cols="50" required></textarea>
                <br>
                <input type="hidden" name="form_submitted" value="1">
                <input type="submit" value="Spara" name="save_desc">
            </form>
            <?php
            if (isset($_SESSION['profile_desc_updated'])) {
                print("<p>Profilbeskrivning uppdaterad!</p>");
                unset($_SESSION['profile_desc_updated']);
            }
            ?>
            <h2>Kommentarsfält</h2>
            <form action="" method="post">
                <label for="comment">Lämna en kommentar:</label>
                <textarea name="comment" id="comment" rows="3" required></textarea>
                <input type="submit" value="Skicka kommentar" name="submit_comment">
            </form>
            <?php include "projcommentfield.php";?> <!-- Inkludera kommentarsfält -->
            <h1>Dejt timer</h1>
            <form action="projprofile.php" method="get">
                <label for="event_date">Tillägg datum för dejten (DD/MM/YYYY):</label>
                <input type="text" id="event_date" name="event_date" placeholder="DD/MM/YYYY" required>
                <input type="submit" value="Bekräfta">
            </form>
            <?php include "projtimestamp.php"; ?> <!-- Inkludera tidsstämpel -->
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const images = document.querySelectorAll('.selectable-image');
            images.forEach(image => {
                image.addEventListener('click', function() {
                    this.closest('form').submit();
                });
            });
        });
    </script>
</body>
</html>


