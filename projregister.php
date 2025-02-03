<?php
require_once "projhandy_methods.php";
include "projlogin.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    if (!empty($username) && !empty($password)) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Store the user in the session for simplicity (in a real application, you would store this in a database)
        $_SESSION['users'][] = [
            'username' => $username,
            'password' => $hashed_password
        ];

        // Set a cookie for the first visit
        if (!isset($_COOKIE['first_visit'])) {
            setcookie('first_visit', time(), time() + (86400 * 30), "/");
            $_SESSION['first_visit_time'] = date("d-m-Y H:i:s");
        }

        $_SESSION['register_message'] = "Registreringen lyckades! Du kan nu logga in.";
        header("Location: projlogin.php");
        exit();
    } else {
        $_SESSION['register_message'] = "Vänligen fyll i båda fälten.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save the dayte</title>
    <link rel="stylesheet" href="./projstyle.css">
</head>
<body>
    <div id="container">
        <h2>Registrera</h2>
        <?php
        if (isset($_SESSION['register_message'])) {
            print($_SESSION['register_message']);
            unset($_SESSION['register_message']);
        }
        ?>
        <form action="register.php" method="POST" autocomplete="off">
            Username: <input type="text" name="username" required autocomplete="off">
            Password: <input type="password" name="password" required autocomplete="off">
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
