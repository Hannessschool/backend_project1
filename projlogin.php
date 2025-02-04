<?php
include_once "projhandy_methods.php";
include_once "projpasswordhandling.php";

if (!isset($_SESSION['users'])) {
    $_SESSION['users'] = [
        ['username' => 'user1', 'password' => password_hash('password123', PASSWORD_DEFAULT)],
        ['username' => 'user2', 'password' => password_hash('password456', PASSWORD_DEFAULT)],
        ['username' => 'hhaanneess@outlook.com', 'password' => password_hash('Hantuchov96!?', PASSWORD_DEFAULT)], // Example hashed password
    ];
}

// Handle POST request for login and password change
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Change password action
    if (isset($_POST['action']) && $_POST['action'] === 'new_password')
    {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];

        $user_found = false;
        // Loop through users to find the current user
        foreach ($_SESSION['users'] as &$user)
        {
            if ($user['username'] === $_SESSION['username'])
            {
                // Verify current password
                if (password_verify($currentPassword, $user['password']))
                {
                    // Hash new password and update
                    $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
                    $_SESSION['login_message'] = "Password changed successfully!";
                    $user_found = true;
                    break;
                }
                else
                {
                    $_SESSION['login_message'] = "Current password is incorrect.";
                    $user_found = true;
                    break;
                }
            }
        }

        if (!$user_found)
        {
            $_SESSION['login_message'] = "User not found!";
        }
    } 
    // Login action
    else
    {
        if (empty($_POST['username']) || empty($_POST['password']))
        {
            $_SESSION['login_message'] = "Please fill in both username and password.";
        } 
        else
        {
            $username = test_input($_POST['username']);
            $password = test_input($_POST['password']);

            $user_found = false;
            // Loop through users to find the matching credentials
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
                $_SESSION['login_message'] = "Welcome, $username!";
                $_SESSION['bio'] = "$username's profil";

                // Set a cookie for the first visit if not already set
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

                // Special case for master user
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
                $_SESSION['login_message'] = "Inkorrekt användarnamn eller lösenord. Vänligen försök på nytt.";
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
    <div id="container">    <!-- Max width 800px -->
    <?php include "projheader.php"; ?>
        <section> 
            <article>
            <h2>Login</h2>
            <?php 
            if(isset($_SESSION['login_success']))
            {
                unset($_SESSION['login_success']);
            }
            else
            {
                print('<form action="projlogin.php" method="POST" autocomplete="off">
                Username: <input type= "text" name= "username" required autocomplete="off">
                Password: <input type= "password" name= "password" required autocomplete="off">
                <input type="submit" value="Login">
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
                    Nuvarande lösenordet: <input type= "password" name="current_password" required autocomplete="off">
                    Nya lösenordet: <input type= "password" name="new_password" required autocomplete="off">
                    <input type="submit" value="Change password">
                </form>
                <?php
                ?>
                <article>
                <h1>Gå till profil</h1>
                <li><a href="projprofile.php">Profil</a></li>
                </article>
                <article>
                <h1>Besöksdata</h1>
                <?php include "projsitedata.php";?>
                </article>

        </section>
    </div>
</body>
</html>
