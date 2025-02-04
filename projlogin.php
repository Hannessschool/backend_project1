<?php
include_once "projhandy_methods.php";
include_once "projpasswordhandling.php";

// Kontrollera om användarsessionen är satt
if (!isset($_SESSION['users'])) {
    // Om ingen användare hittas, skapa en lista med användare och deras hashade lösenord
    $_SESSION['users'] = [
        ['username' => 'user1', 'password' => password_hash('password123', PASSWORD_DEFAULT)],
        ['username' => 'user2', 'password' => password_hash('password456', PASSWORD_DEFAULT)],
        ['username' => 'hhaanneess@outlook.com', 'password' => password_hash('Hantuchov96!?', PASSWORD_DEFAULT)], // Exempel på hashat lösenord
    ];
}

// Hantera POST-förfrågan för inloggning och lösenordsbyte
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Åtgärd för lösenordsbyte
    if (isset($_POST['action']) && $_POST['action'] === 'new_password')
    {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];

        $user_found = false;
        // Loop genom användarna för att hitta den aktuella användaren
        foreach ($_SESSION['users'] as &$user)
        {
            if ($user['username'] === $_SESSION['username'])
            {
                // Verifiera nuvarande lösenord
                if (password_verify($currentPassword, $user['password']))
                {
                    // Hasha det nya lösenordet och uppdatera
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
            $_SESSION['login_message'] = "Användare hittades inte!";
        }
    } 
    // Åtgärd för inloggning
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
            // Loop genom användarna för att hitta matchande inloggningsuppgifter
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
                    header("Refresh: 3; url=projprofile.php");
                    exit();
                }

                // Redirect to the same login page
                header("Location: projlogin.php");
                exit();
            } 
            else
            {
                // Om användarnamn eller lösenord är felaktigt, skriv ut ett felmeddelande
                $_SESSION['login_message'] = "Felaktigt användarnamn eller lösenord. Försök igen.";
            }
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
    <div id="container">    <!-- Maxbredd 800px -->
    <?php include "projheader.php"; ?>
        <section> 
            <article>
            <h2>Inloggning</h2>
            <?php 
            if(isset($_SESSION['login_success']))
            {
                unset($_SESSION['login_success']);
            }
            else
            {
                print('<form action="projlogin.php" method="POST" autocomplete="off">
                Användarnamn: <input type= "text" name= "username" required autocomplete="off">
                Lösenord: <input type= "password" name= "password" required autocomplete="off">
                <input type="submit" value="Logga in">
                </form>');
            }

            if(isset($_SESSION['login_message']))
            {
                print($_SESSION['login_message']);
                unset($_SESSION['login_message']);
            }
            ?>
            </article>
                <h1>Ändra lösenordet</h1>
                <button onclick="toggleChangePasswordForm()">Ändra lösenord</button>
                <form id="changePasswordForm" action="projlogin.php" method="POST" autocomplete="off" style="display:none;">
                    <input type="hidden" name="action" value="new_password">
                    Nuvarande lösenord: <input type= "password" name="current_password" required autocomplete="off">
                    Nytt lösenord: <input type= "password" name="new_password" required autocomplete="off">
                    <input type="submit" value="Byt lösenord">
                </form>
                <?php
                if (isset($_POST['username']))
                {
                    print("Nuvarande användarnamn: " . htmlspecialchars($_POST['username']) . "<br>");
                }
                if (isset($_POST['password']))
                {
                    print("Nuvarande lösenord: " . htmlspecialchars($_POST['password']) . "<br>");
                }
                ?>
                <article>
                <li><a href="projprofile.php">Gå till profil</a></li>
                </article>    
        </section>
    </div>
</body>
</html>
