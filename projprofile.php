<?php 
include "projhandy_methods.php";

// Kontrollera om användarnamn är satt i sessionen
if(!isset($_SESSION['username']))
{
    // Om användarnamn inte är satt, omdirigera till inloggningssidan
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
    <div id="container">    <!-- Maxbredd 800px -->
        <?php include "projheader.php"; ?>
        <section>
            <h1>Profilinfo</h1>
            Din profil:
            <?php
            // Visa användarens bio om den är satt
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
<<<<<<< HEAD
                <h1>Redigera profil</h1>
=======
            <h1>Redigera profil</h1>
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
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
<<<<<<< HEAD
                    // Visa profilbeskrivningen om filen finns
=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
                    if (file_exists("profile_desc.txt")) {
                        print(htmlspecialchars(file_get_contents("profile_desc.txt")));
                    }
                ?></textarea>
                <br>
                <input type="submit" value="Spara" name="save_desc">
            </form>

            <?php
<<<<<<< HEAD
            // Spara den nya profilbeskrivningen om formuläret skickas
            if (isset($_POST['save_desc']) && isset($_POST['profile_desc'])) {
                $desc = trim($_POST['profile_desc']); // Tar bort extra space
                $safeDesc = htmlspecialchars($desc); // Förebygger HTML tags
=======
            if (isset($_POST['save_desc']) && isset($_POST['profile_desc'])) {
                $desc = trim($_POST['profile_desc']); // tar bort extra space
                $safeDesc = htmlspecialchars($desc); // Hindrar för många HTML tags
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
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
                    <input type="submit" value="Bekräfta">
                </form>
                <?php include "projtimestamp.php"; ?>
            </article>     
    </section>
</form>
</body>
</html>
