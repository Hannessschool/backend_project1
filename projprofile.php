<?php 
include "projhandy_methods.php"; // Inkludera hjälpfunktioner

// Kontrollera om användaren är inloggad
if(!isset($_SESSION['username']))
{
    header("Location: projlogin.php"); // Omdirigera till inloggningssidan om användaren inte är inloggad
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
            <form action="" method="post">
                <textarea name="profile_desc" rows="4" cols="50" required>
                <?php
                    // Visa befintlig profilbeskrivning om den finns
                    if (file_exists("profile_desc.txt")) {
                        print(htmlspecialchars(file_get_contents("profile_desc.txt")));
                    }
                ?>
                </textarea>
                <br>
                <input type="submit" value="Spara" name="save_desc">
            </form>
            <?php
            // Spara profilbeskrivningen om formuläret har skickats
            if (isset($_POST['save_desc']) && isset($_POST['profile_desc']))
            {
                $desc = trim($_POST['profile_desc']); // Ta bort extra mellanslag
                $safeDesc = htmlspecialchars($desc); // Hindra för många HTML-taggar
                file_put_contents("profile_desc.txt", $safeDesc);
                print("<p>Profilbeskrivning uppdaterad!</p>"); // Meddelande om profilbeskrivningen har uppdaterats
                
                print('<script type="text/javascript">document.getElementById("profile_desc").value = "";</script>');
            }
            ?>
        </article>
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

