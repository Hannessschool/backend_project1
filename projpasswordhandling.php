<?php
function changePassword($currentPassword, $newPassword)
{
    // Kontrollera om användarlistan finns i sessionen
    if(!isset($_SESSION['users']))
    {
        print("Användare hittas inte"); // Meddelande om användare inte hittas
        return;
    }

    $users = $_SESSION['users'];
    $passwordChanged = false;

    // Loop genom användare för att hitta den aktuella användaren
    foreach($users as &$user)
    {
        if(password_verify($currentPassword, $user['password']))
        {
            // Hasha nytt lösenord och uppdatera
            $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $passwordChanged = true;
            break;
        }
    }

    if($passwordChanged)
    {
        $_SESSION['users'] = $users; // Uppdatera användarlistan i sessionen
        print("Byte av lösenord lyckades"); // Meddelande om lösenordsbyte lyckades
    }
    else
    {
        print("Inkorrekt användarnamn eller lösenord"); // Meddelande om felaktigt användarnamn eller lösenord
    }
}
// lösenordsbytesfunktion slutförd
?>
