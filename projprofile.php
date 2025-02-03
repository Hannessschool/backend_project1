<?php 
include "projhandy_methods.php";

if(!isset($_SESSION['username']))
{
    header("Location: projlogin.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilsida</title>
    <link rel="stylesheet" href="./projstyle.css">
</head>
<body>
    <div id="container">    <!-- Max width 800px -->
        <?php include "projheader.php"; ?>
        <section>
            <h1>Profilinfo</h1>
            Din profil:
            <?php
            if(isset($_SESSION['bio']))
            {
                print(htmlspecialchars(($_SESSION['bio'])));
            }
            else
            {
                print("Ingen bio tillgänglig ännu");
            }
            ?>
            <a href="projprofile.php">Redigera Profil</a>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <label for="fileToUpload">Välj bild att ladda ner:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Upload Image" name="submit">
            </form>
            <article>
                <h2>Ladda ner fil</h2>
                <?php include "projupload.php";?>
            </article>
            <article>
                <h2>Besöksdata</h2>
                <?php include "projsitedata.php";?>
            </article>
            <article>
                <h2>Dejt timer</h2>
                <form action="projprofile.php" method="get">
                    <label for="event_date">Tillägg datum för dejten (DD/MM/YYYY):</label>
                    <input type="text" id="event_date" name="event_date" placeholder="DD/MM/YYYY" required>
                    <input type="submit" value="Submit">
                </form>
                <?php include "projtimestamp.php"; ?>
            </article>     
    </section>
</form>
</body>
</html>