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
        $_SESSION['message'] = "Användarnamn och e-post måste fyllas i!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Ogiltig e-postadress!";
    } elseif (strlen($username) < 3 || strlen($username) > 20) {
        $_SESSION['message'] = "Användarnamnet måste vara 3-20 tecken långt!";
    } else {
        // Skapande av lösenord på 8 tecken
        $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789"), 0, 8);

        // Skicka email
        $to = $email;
        $subject = "Ditt nya lösenord";
        $message = "Hej $username!\n\nDitt nya lösenord är: $password\n\nVänligen ändra ditt lösenord efter inloggning.";
        $headers = "From: no-reply@yourdomain.com\r\nReply-To: support@yourdomain.com";

        if (mail($to, $subject, $message, $headers)) {
            $_SESSION['message'] = "Registrering lyckades! Kontrollera din e-post för lösenordet.";
            $_SESSION['users'][] = [
                'username' => $username, // Email as username
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ];
        } else {
            error_log("Email sending failed to $email");
            $_SESSION['message'] = "Ett fel uppstod vid e-postleveransen.";
        }
    }

    // Omdirigering
    header("Location: projregister.php");
    exit();
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
    <div id="container">
    <?php include "projheader.php"; ?>
        <h2>Registrera dig</h2>
        <?php
        if (isset($_SESSION['message'])) {
            print("<p><strong>" . $_SESSION['message'] . "</strong></p>");
            unset($_SESSION['message']);
        }
        print('<li><a href="projlogin.php">Gå till inloggingen</a></li>');
        ?>
    </div>
</body>
</html>


