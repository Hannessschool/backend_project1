<?php
session_start(); // Starta sessionen
session_unset(); // Rensa alla sessionsvariabler
session_destroy(); // Förstör sessionen
header("Location: projlogin.php"); // Omdirigera till inloggningssidan efter utloggning
exit();
?>
