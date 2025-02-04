<?php
function changePassword($currentPassword, $newPassword)
{
    // Kontrollera om användarsessionen är satt
    if(!isset($_SESSION['users']))
    {
        // Om ingen användare hittas, skriv ut ett meddelande och avsluta funktionen
        print("Användare hittas inte");
        return;
    }

    // Hämta användarna från sessionen
    $users = $_SESSION['users'];
    $passwordChanged = false;

    // Loop genom varje användare
    foreach($users as &$user)
    {
        // Kontrollera om det nuvarande lösenordet är korrekt
        if(password_verify($currentPassword, $user['password']))
        {
            // Om lösenordet är korrekt, uppdatera det med det nya lösenordet
            $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $passwordChanged = true;
            break;
        }
    }

    // Om lösenordet ändrades, uppdatera sessionen och skriv ut ett framgångsmeddelande
    if($passwordChanged)
    {
        $_SESSION['users'] = $users;
        print("Byte av lösenord lyckades");
    }
    else
    {
        // Om lösenordet inte ändrades, skriv ut ett felmeddelande
        print("Inkorrekt användarnamn eller lösenord");
    }
}
// lösenordsbytesfunktion slutförd
?>
