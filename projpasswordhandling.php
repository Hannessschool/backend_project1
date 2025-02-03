<?php
function changePassword($currentPassword, $newPassword)
{
    if(!isset($_SESSION['users']))
    {
        print("Användare hittas inte");
        return;
    }

    $users = $_SESSION['users'];
    $passwordChanged = false;

    foreach($users as &$user)
    {
        if(password_verify($currentPassword, $user['password']))
        {
            $user['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            $passwordChanged = true;
            break;
        }
    }

    if($passwordChanged)
    {
        $_SESSION['users'] = $users;
        print("Byte av lösenord lyckades");
    }
    else
    {
        print("Inkorrekt användarnamn eller lösenord");
    }
}
//lösenordsbytesfunktion slutförd
?>