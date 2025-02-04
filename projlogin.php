<?php
include_once "projhandy_methods.php"; // Inkludera hjälpfunktioner
include_once "projpasswordhandling.php"; // Inkludera lösenordshantering

$register_message = isset($_SESSION['register_message']) ? $_SESSION['register_message'] : ''; // Hämta registreringsmeddelande från sessionen
unset($_SESSION['register_message']); // Ta bort registreringsmeddelandet från sessionen

// Kontrollera om användarlistan är satt i sessionen
if (!isset($_SESSION['users'])) {
    // Om inte, skapa en standardlista med användare
    $_SESSION['users'] = [
        ['username' => 'user1', 'password' => password_hash('password123', PASSWORD_DEFAULT)],
        ['username' => 'user2', 'password' => password_hash('password456', PASSWORD_DEFAULT)],
        ['username' => 'hhaanneess@outlook.com', 'password' => password_hash('HHaanneess', PASSWORD_DEFAULT)], // Exempel på hashat lösenord
    ];
}

// Hantera POST-förfrågan för inloggning och lösenordsbyte
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Lösenordsbyte
    if (isset($_POST['action']) && $_POST['action'] === 'new_password')
    {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];

        $user_found = false;
        // Loop genom användare för att hitta den aktuella användaren
        foreach ($_SESSION['users'] as &$user)
        {
            if ($user['username'] === $_SESSION['username'])
            {
                // Verifiera nuvarande lösenord
                if (password_verify($currentPassword, $user['password']))
                {
                    // Hasha nytt lösenord och uppdatera
                    $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                    $_SESSION['login_message'] = "Lösenordet har ändrats!";
                    $user_found = true;
                    break;
                }
                else
                {
                    $_SESSION['login_message'] = "Nuvarande lösenord är felaktigt.";
                    $user_found = true;
                    break;
                }
            }
        }

        if (!$user_found)
        {
            $_SESSION['login_message'] = "Användaren hittades inte!";
        }
    } 
    // Inloggning
    else
    {
        if (empty($_POST['username']) || empty($_POST['password']))
        {
            $_SESSION['login_message'] = "Vänligen fyll i både användarnamn och lösenord.";
        } 
        else
        {
            $username = test_input($_POST['username']);
            $password = test_input($_POST['password']);

            $user_found = false;
            // Loop genom användare för att hitta matchande inloggningsuppgifter
            foreach ($_SESSION['users'] as $user)
            {
                if ($user['username'] === $username && password_verify($password, $user['password']))
                {
                    $user_found = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['login_success'] = true;
                    break;
                }
            }

            if ($user_found)
            {
                $_SESSION['login_message'] = "Välkommen, $username!";
                $_SESSION['bio'] = "$username's profil";

                // Sätt en cookie för första besöket om den inte redan är satt
                if (!isset($_COOKIE['first_visit']))
                {
                    setcookie('first_visit', time(), time() + (86400 * 30), "/");
                    $_SESSION['first_visit_time'] = date("d-m-Y H:i:s");
                    $_SESSION['login_message'] = "Hej $username,\n\nDitt konto har skapats. Ditt lösenord är: $password\n\nVänligen ändra ditt lösenord efter inloggning.";
                }
                else
                {
                    $firstVisitTime = isset($_SESSION['first_visit_time']) ? $_SESSION['first_visit_time'] : date("d-m-Y H:i:s", $_COOKIE['first_visit']);
                    $_SESSION['login_message'] = "Välkommen tillbaka, $username! Ditt senaste besök var: $firstVisitTime";
                }
                // Specialfall för masteranvändare
if ($username == "eerolaha@arcada")
{
    $_SESSION['login_message'] = "Välkommen master Hannes. Omdirigerar till profilen";
    header("Refresh: 3; url=projprofile.php"); // Omdirigera till profilen efter 3 sekunder
    exit();
}

// Omdirigera till samma inloggningssida
header("Location: projlogin.php");
exit();
} 
else
{
    $_SESSION['login_message'] = "Inkorrekt användarnamn eller lösenord. Vänligen försök på nytt."; // Felmeddelande vid felaktigt användarnamn eller lösenord
}
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save The Dayte</title>
    <link rel="stylesheet" href="./projstyle.css">
    <script>
        // Funktion för att visa eller dölja formuläret för lösenordsbyte
        function toggleChangePasswordForm() {
            var form = document.getElementById('changePasswordForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div id="container">    <!-- Max bredd 800px -->
    <?php include "projheader.php"; ?>
        <section> 
            <article>
            <?php 
            // Kontrollera om inloggningen lyckades
            if(isset($_SESSION['login_success']) && $_SESSION['login_success'] === true)
            {
                print('<h1>Ändra lösenordet</h1>');
                print('<button onclick="toggleChangePasswordForm()">Ändra lösenord</button>');
                print('<form id="changePasswordForm" action="projlogin.php" method="POST" autocomplete="off" style="display:none;">
                    <input type="hidden" name="action" value="new_password">
                    Nuvarande lösenordet: <input type="password" name="current_password" required autocomplete="off">
                    Nya lösenordet: <input type="password" name="new_password" required autocomplete="off">
                    <input type="submit" value="Change password">
                    </form>');
                print("<h1>Gå till profil</h1>");
                print('<li><a href="projprofile.php">Profil</a></li>');
                print('<h1>Besöksdata</h1>');
                include "projsitedata.php"; // Inkludera besöksdata

            }
            else
            {
                print('<h1>Logga in</h1>');
                print('<form action="projlogin.php" method="POST" autocomplete="off">
                Användarnamn: <input type="text" name="username" required autocomplete="off">
                Lösenord: <input type="password" name="password" required autocomplete="off">
                <input type="submit" value="Login">
                </form>');
            }

            // Visa inloggningsmeddelande om det finns
            if(isset($_SESSION['login_message']))
            {
                print($_SESSION['login_message']);
                unset($_SESSION['login_message']);
            }
            ?>
            </article>
        </section>
    </div>
</body>
</html>
