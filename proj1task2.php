<!DOCTYPE html>
<html lang="swe">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datum för dejten</title>
</head>
<body>
    <form action ="process_date.php" method="post">
        <label for="event_date">Vänligen insätt datumet för din dejt (DD/MM/ÅÅÅÅ):</label>
        <input type="text" id="event_date" name="event_date" placeholder="DD/MM/YYYY" required>
        <input type="submit" value="Submit">
    </form>
<?php
$textual_date_format = date("F j", $timestamp);
print($textual_date_format);
if ($_SERVER["REQUEST_METHOD"] == "GET"){
    $event_date = $_GET['event_date'];


    //validate the inserted date format

    list($day, $month, $year) = explode("/", $event_date);
    $timestamp = strtotime("$year-$month-$day");

    if($timestamp){
        $diff = $timestamp - time();

        $days = floor($diff / 86400);
        $hours = floor(($diff % 86400) / 3600);
        $minutes = floor(($diff % 3600) / 60);
        $seconds = $diff % 60;

        print("Det är $days dagar, $hours timmar, $minutes minuter, och $seconds sekunder tills din dejt");
    }
    else
    {
        print("Oanvändbart datumformat. Vänligen insätt datumet i DD/MM/ÅÅÅÅ-format.");
    }
}
?>
</body>
</html>