<?php
require_once "projhandy_methods.php"; // Inkludera hjälpfunktioner

// Funktion för validering
function validate_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Kolla ifall formen har skickats på nytt
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate_input($_POST['username']);
    $email = validate_input($_POST['email']);

    // Validering
    if (empty($username) || empty($email)) {
        $_SESSION['register_message'] = "Användarnamn och e-post måste fyllas i!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_message'] = "Ogiltig e-postadress!";
    } elseif (strlen($username) < 3 || strlen($username) > 20) {
        $_SESSION['register_message'] = "Användarnamnet måste vara 3-20 tecken långt!";
    } else {
        // Skapande av lösenord på 8 tecken
        $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);

        // Skicka email
        $to = $email;
        $subject = "Ditt nya lösenord";
        $message = "Hej $username!\n\nDitt nya lösenord är: $password\n\nVänligen ändra ditt lösenord efter inloggning.";
        $headers = "From: no-reply@yourdomain.com\r\nReply-To: support@yourdomain.com";

        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['register_message'] = "Registrering lyckades! Kontrollera din e-post för lösenordet.";
            $_SESSION['register_success'] = true;
            $_SESSION['users'][] = [
                'username' => $username, // Email as username
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
        } else {
            error_log("Email sending failed to $email");
            $_SESSION['register_message'] = "Ett fel uppstod vid e-postleveransen.";
        }
    }

    // Omdirigering
    header("Location: projregister.php");
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
    <script>
        // JavaScript för att hantera en omdirigering vid lyckad registrering efter några sekunder till login, efter att ha först visat meddelande om lyckad registrering
        function redirectToLogin() {
            setTimeout(function() {
                window.location.href = "projlogin.php";
            }, 3000); // 3000 milliseconds = 3 seconds
        }
    </script>
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
                if($_SESSION['register_success'])
                {
                    print("<script>redirectToLogin();</script>");
                    unset($_SESSION['register_success']);
                }
                unset($_SESSION['register_message']);
            }
            ?>
            <form action="projregister.php" method="POST" autocomplete="off">
                Användarnamn: <input type="text" name="username" required autocomplete="off">
                E-post: <input type="text" name="email" required autocomplete="off">
                <input type="submit" value="Registrera">
            </form>
            <p>Har du redan konto sen tidigare? <a href="projlogin.php">Logga in här</a></p>
        </section>
    </div>
</body>
</html>


