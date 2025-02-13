<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Funktion för att testa och rensa indata
function test_input($data)
{
    $data = trim($data); // Ta bort onödiga mellanslag
    $data = stripslashes($data); // Ta bort snedstreck
    $data = htmlspecialchars($data); // Konvertera specialtecken till HTML-entiteter
    return $data;
}


