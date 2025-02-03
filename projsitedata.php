<?php

$userCounterFile = 'VisitorCounter.txt';
function visitLog($username)
{
    global $userCounterFile;

    $currentCount = 0;
    if(file_exists($userCounterFile))
    {
        $lines = file($userCounterFile, FILE_IGNORE_NEW_LINES);
        if(!empty($lines[0]))
        {
            $currentCount = (int)$lines[0];
        }
    }

    $currentCount++;
    $timestamp = date("d-m-Y H:i:s");

    $logEntry = $username. 'besökte vid tid: '.$timestamp;
    $fileContent = $currentCount.PHP_EOL.$logEntry.PHP_EOL;
    if(file_exists($userCounterFile))
    {
        $fileContent.= file_get_contents($userCounterFile, false, null, strlen($lines[0]) + 1);
    }
    file_put_contents($userCounterFile, $fileContent);
    print("Du är vår " . $currentCount. " besökare");
}
?>