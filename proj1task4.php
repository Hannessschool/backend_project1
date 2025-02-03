<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    $allowedChars = array_merge(range('a', 'ö'), 
    range('A', 'Z'), range(0, 9));
    $password = "";

    for ($i = 0; $i < 10; $i++)
    {
        $password .= $allowedChars[random_int(0, count($allowedChars) - 1)];
    }

    $email = "someone@example.com";
    
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        if (mail($email, "My subject", $password)) 
        {
            print("Email sent successfully.");
        } 
        else
        {
            print("Failed to send email.");
        }
    }
    else
    {
        print("Invalid email address.");
    }

    $username = "exampleUser";
    $_SESSION['username'] = $username;  //lagring av användarnamnet i en sessionsvariabel

    if(!isset($_SESSION['last_visit']))  // checkning ifall det finns en förra visit, eller om det skulle vara första visiten
    {
        $_SESSION['last_visit'] = time();  
    }
    else                                     //vad som händer ifall det inte är första visiten
    {
        $last_visit = $_SESSION['last_visit']; // förra visitens tid presenteras
        $_SESSION['last_visit'] = time();   //uppdatering av senaste visiten till nutiden
    }

    //omdirigering till välkommen-sida
    header("Location: xxx.php");
    exit();
    ?>
</body>
</html>