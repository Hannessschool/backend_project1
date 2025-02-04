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
            <article>
            <h1>Redigera profil</h1>
                <h2>Ladda upp fil</h2>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="fileToUpload">Välj bild att ladda upp:</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <input type="submit" value="Bekräfta uppladdning" name="submit">
                </form>
                <h2>Kommentarsfält</h2>
                <form action="" method="post">
                    <label for="comment">Lämna en kommentar:</label>
                    <textarea name="comment" id="comment" rows="3" required></textarea>
                    <input type="submit" value="Skicka kommentar" name="submit_comment">
                </form>
                <?php include "projcommentfield.php";?>
            </article>
            <article>
            <h2>Profilbeskrivning</h2>
            <form action="" method="post">
                <textarea name="profile_desc" rows="4" cols="50" required><?php
                    if (file_exists("profile_desc.txt")) {
                        print(htmlspecialchars(file_get_contents("profile_desc.txt")));
                    }
                ?></textarea>
                <br>
                <input type="submit" value="Spara" name="save_desc">
            </form>

            <?php
            if (isset($_POST['save_desc']) && isset($_POST['profile_desc'])) {
                $desc = trim($_POST['profile_desc']); // tar bort extra space
                $safeDesc = htmlspecialchars($desc); // Hindrar för många HTML tags
                file_put_contents("profile_desc.txt", $safeDesc);
                print("<p>Profilbeskrivning uppdaterad!</p>");
            }
            ?>
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