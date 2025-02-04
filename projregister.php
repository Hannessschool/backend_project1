<?php
require_once "projhandy_methods.php"; // Inkludera hjälpfunktioner
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Aktivera felrapportering

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    if (!empty($username) && !empty($password))
    {
        // Hasha lösenordet innan det lagras
        echo "Username and password are not empty.<br>";
        $user_exists = false;
        if (isset($_SESSION['users']))
        {
            foreach ($_SESSION['users'] as $user)
            {
                if ($user['username'] === $username)
                {
                    $user_exists = true;
                    break;
                }
            }
        }

        if($user_exists)
        {
            $_SESSION['register_message'] = "Användarnamnet är redan taget. Vänligen välj ett annat."; // Meddelande om användarnamnet redan är taget
        }
        else
        {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Lagra användaren i sessionen för enkelhetens skull (i en riktig applikation skulle du lagra detta i en databas)
            $_SESSION['users'][] = [
                'username' => $username,
                'password' => $hashed_password
            ];

            // Sätt en cookie för första besöket
            if (!isset($_COOKIE['first_visit']))
            {
                setcookie('first_visit', time(), time() + (86400 * 30), "/");
                $_SESSION['first_visit_time'] = date("d-m-Y H:i:s");
            }

            $_SESSION['register_message'] = "Registreringen lyckades! Du kan nu logga in."; // Meddelande om registreringen lyckades
            header("Location: projlogin.php");
            exit();
        }
    } 
    else
    {
        $_SESSION['register_message'] = "Vänligen fyll i båda fälten."; // Meddelande om att fylla i båda fälten
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
</head>
<body>
    <div id="container">
    <?php include "projheader.php"; ?>
        <section>
            <h1>Registrera</h1>
            <?php
            if (isset($_SESSION['register_message']))
            {
                print("<p class='error-message'>" . $_SESSION['register_message'] . "</p>");
                unset($_SESSION['register_message']);
            }
            ?>
            <form action="projregister.php" method="POST" autocomplete="off">
                Användarnamn: <input type="text" name="username" required autocomplete="off">
                Lösenord: <input type="password" name="password" required autocomplete="off">
                <input type="submit" value="Registrera">
            </form>
            <p>Har du redan konto sen tidigare? <a href="projlogin.php">Logga in här</a></p>
        </section>
    </div>
</body>
</html>


