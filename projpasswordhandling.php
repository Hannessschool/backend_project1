<?php
function changePassword($currentPassword, $newPassword)
{
<<<<<<< HEAD
    // Kontrollera om användarlistan finns i sessionen
    if(!isset($_SESSION['users']))
    {
        print("Användare hittas inte"); // Meddelande om användare inte hittas
=======
    // Kontrollera om användarsessionen är satt
    if(!isset($_SESSION['users']))
    {
        // Om ingen användare hittas, skriv ut ett meddelande och avsluta funktionen
        print("Användare hittas inte");
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
        return;
    }

    // Hämta användarna från sessionen
    $users = $_SESSION['users'];
    $passwordChanged = false;

<<<<<<< HEAD
    // Loop genom användare för att hitta den aktuella användaren
=======
    // Loop genom varje användare
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    foreach($users as &$user)
    {
        // Kontrollera om det nuvarande lösenordet är korrekt
        if(password_verify($currentPassword, $user['password']))
        {
<<<<<<< HEAD
            // Hasha nytt lösenord och uppdatera
=======
            // Om lösenordet är korrekt, uppdatera det med det nya lösenordet
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
            $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $passwordChanged = true;
            break;
        }
    }

    // Om lösenordet ändrades, uppdatera sessionen och skriv ut ett framgångsmeddelande
    if($passwordChanged)
    {
        $_SESSION['users'] = $users; // Uppdatera användarlistan i sessionen
        print("Byte av lösenord lyckades"); // Meddelande om lösenordsbyte lyckades
    }
    else
    {
<<<<<<< HEAD
        print("Inkorrekt användarnamn eller lösenord"); // Meddelande om felaktigt användarnamn eller lösenord
=======
        // Om lösenordet inte ändrades, skriv ut ett felmeddelande
        print("Inkorrekt användarnamn eller lösenord");
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
    }
}
// lösenordsbytesfunktion slutförd
?>
