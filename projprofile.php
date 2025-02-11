<?php 
include "projhandy_methods.php"; // Inkludera hjälpfunktioner

// Kontrollera om användaren är inloggad
if(!isset($_SESSION['username']))
{
    header("Location: projlogin.php"); // Omdirigera till inloggningssidan om användaren inte är inloggad
    exit();
}

if (isset($_POST['save_desc']) && isset($_POST['profile_desc']))
 {
    $desc = trim($_POST['profile_desc']); // Ta bort extra space
    $safeDesc = htmlspecialchars($desc); // Förhindra för många HTML tags
    file_put_contents("profile_desc.txt", $safeDesc);
    $_SESSION['profile_desc_updated'] = true; // Sätt en sessionsvariable för att indikera att profilbeskrivningen var uppdaterad
    header("Location: " . $_SERVER['PHP_SELF']."?updated=true"); // Omdirigera till annat ställe på sidan
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
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
            if (isset($_SESSION['username'])) 
            {
                print("<span class='subtle-username'>". htmlspecialchars($_SESSION['username']) . "</span>");
            }     
            // Visa uppladdade filen om sådan finns
            if (isset($_SESSION['uploaded_image']))
            {
                $uploaded_image_path = 'pictures/'. $_SESSION['uploaded_image'];
                if(file_exists($uploaded_image_path))
                {
                    print("<p><a href='" . $uploaded_image_path . "' target='_blank'>Click here to view the uploaded image</a></p>");
                    print("<div class='uploaded-image-container'><img src='" . $uploaded_image_path . "' alt='Uploaded Image' style='max-width: 100%; height: auto;'></div>");
                }
            }

            print("<div class='profile-description-container'>");
            print("<h2>Profilbeskrivning</h2>");

            if (file_exists("profile_desc.txt"))
            {
                $profile_desc = htmlspecialchars(file_get_contents("profile_desc.txt"));
                print("<p>" . $profile_desc . "</p>");
            } else
            {
                print("<p>Ingen profilbeskrivning tillgängling ännu.</p>");
            }
            print("</div>");
            ?>
            </article>
            <h1>Redigera profil</h1>
                <h2>Ladda upp fil</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="fileToUpload">Välj bild att ladda upp:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Bekräfta uppladdning" name="submit">
                </form>
            </article>
            <article>
            <h2>Profilbeskrivning</h2>
            <form action="" method="post" onsubmit="clearTextarea()">
                <textarea name="profile_desc" rows="4" cols="50" required>
                </textarea>
                <br>
                <input type="hidden" name="form_submitted" value="1">
                <input type="submit" value="Spara" name="save_desc">
            </form>
            <?php
            if(isset($_SESSION['profile_desc_updated']))
            {
                print("<p>Profilbeskrivning uppdaterad!</p>"); //meddelande som bekräftar lyckad postande av profilbeskrivninh
                unset($_SESSION['profile_desc_updated']); //nollställ sessionvariabeln
            }
            ?>
        </article>
        <script>
            function clearTextarea()
            {
                document.getElementById('profile_desc').value = '';
            }

            window.onload = function()
            {
                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('updated') && urlParams.get('updated') === 'true') {
                    clearTextarea();
                }
            };
            </script>
        <article>
            <h2>Kommentarsfält</h2>
            <form action="" method="post">
                <label for="comment">Lämna en kommentar:</label>
                <textarea name="comment" id="comment" rows="3" required></textarea>
                <input type="submit" value="Skicka kommentar" name="submit_comment">
            </form>
            <?php include "projcommentfield.php";?> <!-- Inkludera kommentarsfält -->
        </article>
        <article>
            <h1>Dejt timer</h1>
            <form action="projprofile.php" method="get">
                <label for="event_date">Tillägg datum för dejten (DD/MM/YYYY):</label>
                <input type="text" id="event_date" name="event_date" placeholder="DD/MM/YYYY" required>
                <input type="submit" value="Bekräfta">
            </form>
            <?php include "projtimestamp.php"; ?> <!-- Inkludera tidsstämpel -->
        </article>     
    </section>
</form>
</body>
</html>

