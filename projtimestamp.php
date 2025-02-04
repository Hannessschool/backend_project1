<?php
<<<<<<< HEAD
$timestamp_output = "";  // Detta kommer att hålla tidsstämpelns utdata efter beräkning.

function getWeekNumber($eventDate)
{
    // Skapa ett DateTime-objekt från händelsedatumet
    $dateWeek = new DateTime($eventDate);

    // Returnera ISO-8601 veckonummer
    return $dateWeek->format('W');
}

=======
$timestamp_output = "";  // This will hold the timestamp output after calculation.

function getWeekNumber($eventDate)
{
    // Create a DateTime object from the event date
    $dateWeek = new DateTime($eventDate);

    // Return the ISO-8601 week number
    return $dateWeek->format('W');
}
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['event_date']))
{
    $event_date = $_GET['event_date'];
    list($day, $month, $year) = explode("/", $event_date);

    // Kontrollera om datumet är giltigt
    if (checkdate($month, $day, $year))
    {
<<<<<<< HEAD
        $formatted_date = "$year-$month-$day"; // För tidsstämpelberäkning
=======
        $formatted_date = "$year-$month-$day"; // For timestamp calculation
>>>>>>> 6886e0be191e393af645a2ff34fac12121e5b44c
        $display_date = "$day/$month/$year";
        $weekNumber = getWeekNumber($formatted_date);

        $timestamp = strtotime($formatted_date);
        $dayOfWeek = date("l", $timestamp);  // Fullständigt veckodagsnamn (t.ex. "Friday")
        $dayOfMonth = date("j", $timestamp); // Dag i månaden (t.ex. "4")
        $monthName = date("F", $timestamp);  // Fullständigt månadsnamn (t.ex. "May")

        // Definiera svenska motsvarigheter för veckodagar och månader
        $weekdays = [
            "Monday"    => "måndag",
            "Tuesday"   => "tisdag",
            "Wednesday" => "onsdag",
            "Thursday"  => "torsdag",
            "Friday"    => "fredag",
            "Saturday"  => "lördag",
            "Sunday"    => "söndag"
        ];

        $months = [
            "January"   => "januari",
            "February"  => "februari",
            "March"     => "mars",
            "April"     => "april",
            "May"       => "maj",
            "June"      => "juni",
            "July"      => "juli",
            "August"    => "augusti",
            "September" => "september",
            "October"   => "oktober",
            "November"  => "november",
            "December"  => "december"
        ];
        
        // Hämta de svenska namnen för veckodagen och månaden
        $swedishDay = isset($weekdays[$dayOfWeek]) ? $weekdays[$dayOfWeek] : $dayOfWeek;
        $swedishMonth = isset($months[$monthName]) ? $months[$monthName] : $monthName;

        $diff = $timestamp - time();
        
        $days = floor($diff / 86400);
        $hours = floor(($diff % 86400) / 3600);
        $minutes = floor(($diff % 3600) / 60);
        $seconds = $diff % 60;

        $timestamp_output = "Din dejt är $swedishDay den $dayOfMonth:e $swedishMonth $year under vecka $weekNumber. \n Det är $days dagar, $hours timmar, $minutes minuter, och $seconds sekunder tills din dejt.";
    } 
    else
    {
        $timestamp_output = "Oanvändbart datumformat. Vänligen insätt datumet i DD/MM/ÅÅÅÅ-format.";
    }
}
else
{
    $formatted_date = "Inget datum angivet!";
}

// Skriv ut tidsstämpelns utdata
print($timestamp_output);
?>
