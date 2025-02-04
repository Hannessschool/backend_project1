<?php
$userCounterFile = 'VisitorCounter.txt';

function visitLog($username = null)
{
    global $userCounterFile;

    $currentCount = 0;
    $logEntries = [];

    // Check if the file exists
    if (file_exists($userCounterFile)) {
        $lines = file($userCounterFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        if (!empty($lines[0]) && is_numeric($lines[0])) {
            $currentCount = (int)$lines[0]; // First line is the counter
            $logEntries = array_slice($lines, 1); // The rest are log entries
        }
    }

    // Increase visit count
    $currentCount++;

    // Get the timestamp
    $timestamp = date("d-m-Y H:i:s");

    // If username is empty, use IP address
    if (empty($username)) {
        $username = $_SERVER['REMOTE_ADDR']; // Gets user's IP address
    }

    // Add new log entry
    $logEntry = "$username besökte vid tid: $timestamp";
    array_unshift($logEntries, $logEntry); // Add to the start

    // Prepare the file content
    $fileContent = $currentCount . PHP_EOL . implode(PHP_EOL, $logEntries) . PHP_EOL;

    // Save back to the file
    file_put_contents($userCounterFile, $fileContent);

    // Display the visitor count
    print("Du är vår besökare nummer $currentCount ");
}

// Example usage:
visitLog(isset($_SESSION['username']) ? $_SESSION['username'] : null);
?>
