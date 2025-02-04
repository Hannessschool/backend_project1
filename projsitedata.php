<?php
$userCounterFile = 'VisitorCounter.txt'; // Fil för att lagra besöksräknare

function visitLog($username = null)
{
    global $userCounterFile;

    $currentCount = 0;
    $logEntries = [];

<<<<<<< HEAD
    // Kontrollera om filen existerar och är läsbar
    if (file_exists($userCounterFile) && is_readable($userCounterFile)) {
        $lines = file($userCounterFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        if (!empty($lines[0]) && is_numeric($lines[0])) {
            $currentCount = (int)$lines[0]; // Första raden är räknaren
            $logEntries = array_slice($lines, 1); // Resten är loggposter
=======
<<<<<<< HEAD
    // Kontrollera om filen finns
=======
    // Check if the file exists
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
    if (file_exists($userCounterFile)) {
        $lines = file($userCounterFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        if (!empty($lines[0]) && is_numeric($lines[0])) {
<<<<<<< HEAD
            $currentCount = (int)$lines[0]; // Första raden är räknaren
            $logEntries = array_slice($lines, 1); // Resten är loggposter
        }
    }

    // Öka besöksräknaren
    $currentCount++;

    // Hämta tidsstämpeln
    $timestamp = date("d-m-Y H:i:s");

    // Om användarnamnet är tomt, använd IP-adressen
    if (empty($username)) {
        $username = $_SERVER['REMOTE_ADDR']; // Hämtar användarens IP-adress
    }

    // Lägg till ny loggpost
    $logEntry = "$username besökte vid tid: $timestamp";
    array_unshift($logEntries, $logEntry); // Lägg till i början

    // Förbered filinnehållet
    $fileContent = $currentCount . PHP_EOL . implode(PHP_EOL, $logEntries) . PHP_EOL;

    // Spara tillbaka till filen
    file_put_contents($userCounterFile, $fileContent);

    // Visa besöksräknaren
    print("Du är vår besökare nummer $currentCount ");
}

// Exempel på användning:
visitLog(isset($_SESSION['username']) ? $_SESSION['username'] : null);
?>

=======
            $currentCount = (int)$lines[0]; // First line is the counter
            $logEntries = array_slice($lines, 1); // The rest are log entries
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
        }
    }

    // Öka besöksräknaren
    $currentCount++;

    // Hämta tidsstämpeln
    $timestamp = date("d-m-Y H:i:s");

    // Om användarnamnet är tomt, använd IP-adressen
    if (empty($username)) {
        $username = $_SERVER['REMOTE_ADDR']; // Hämta användarens IP-adress
    }

    // Lägg till ny loggpost
    $logEntry = "$username besökte vid tid: $timestamp";
    array_unshift($logEntries, $logEntry); // Lägg till i början

    // Förbered filinnehållet
    $fileContent = $currentCount . PHP_EOL . implode(PHP_EOL, $logEntries) . PHP_EOL;

    // Spara tillbaka till filen
    file_put_contents($userCounterFile, $fileContent);

    // Visa besöksräknaren
    print("Du är vår besökare nummer $currentCount ");
}

// Exempel på användning:
visitLog(isset($_SESSION['username']) ? $_SESSION['username'] : null);
?>
<<<<<<< HEAD

=======
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
>>>>>>> 0deaa6eddb4fe890e7fb3fe3da867874caec9c1c
