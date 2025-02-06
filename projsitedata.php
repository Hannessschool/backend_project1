<?php

// Asetetaan aikavyöhyke Helsinkiin
// Ställ in tidszon till Helsingfors
date_default_timezone_set('Europe/Helsinki');

// Tiedostot kävijälaskurin ja vierailijoiden lokin tallentamiseen
// Spara besöksräknaren och besökares logg
$userCounterFile = 'VisitorCounter.txt';
$visitorLogFile = 'VisitorLog.txt'; 

function visitLog($username = null)
{
    global $userCounterFile, $visitorLogFile;

    // Haetaan käyttäjän IP-osoite ja nykyinen aikaleima
    // Hämta användarens IP-adress och aktuell tid
    $userIP = $_SERVER['REMOTE_ADDR'] ?? 'Okänd';
    $timestamp = date("d-m-Y H:i:s");

    // Luetaan aikaisemmat vierailijat lokitiedostosta
    // Läs tidigare besökare
    $existingVisitors = [];
    if (file_exists($visitorLogFile)) {
        $lines = file($visitorLogFile, FILE_IGNORE_NEW_LINES);
        foreach ($lines as $line) {
            list($ip, $time) = explode('|', $line);
            $existingVisitors[$ip] = $time;
        }
    }

    // Jos kävijälaskurin tiedostoa ei ole, luodaan se ja asetetaan laskuri 0:ksi
    // Skapa besöksräknarfil om den saknas
    if (!file_exists($userCounterFile)) {
        file_put_contents($userCounterFile, "0\n");
    }
    $lines = file($userCounterFile, FILE_IGNORE_NEW_LINES);
    $currentCount = isset($lines[0]) && is_numeric($lines[0]) ? (int)$lines[0] : 0;

    // Jos käyttäjää ei ole vielä rekisteröity, lisätään uusi kävijä
    // Registrera ny besökare
    if (!isset($existingVisitors[$userIP])) {
        $currentCount++;
        $existingVisitors[$userIP] = $timestamp;
        
        // Päivitetään lokitiedosto uusilla kävijöillä
        // Uppdatera loggfilen
        $visitorLogContent = "";
        foreach ($existingVisitors as $ip => $time) {
            $visitorLogContent .= "$ip|$time\n";
        }
        file_put_contents($visitorLogFile, $visitorLogContent);

        // Päivitetään kävijälaskurin tiedosto tallentamalla kaikki aikaisemmat kävijät
        // Uppdatera besöksräknarens fil med alla tidigare poster
        $fileContent = "$currentCount\n";
        foreach ($existingVisitors as $ip => $time) {
            $fileContent .= "$ip besökte vid: $time\n";
        }
        file_put_contents($userCounterFile, $fileContent);
    }

    // Näytetään uniikkien kävijöiden määrä
    // Visa antal unika besökare
    print("Du är besökare nummer $currentCount");
    print(". Serverns ip:".$_SERVER['SERVER_ADDR']);
    print(". Skriptet som körs:".$_SERVER['PHP_SELF']);
    print(". Tidszon: " . date_default_timezone_get());
#phpinfo(););
}

// Suoritetaan funktio
// Kör funktionen
visitLog();

?>

