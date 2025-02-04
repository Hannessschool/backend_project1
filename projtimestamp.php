<?php
$timestamp_output = "";  // This will hold the timestamp output after calculation.

function getWeekNumber($eventDate)
{
    // Create a DateTime object from the event date
    $dateWeek = new DateTime($eventDate);

    // Return the ISO-8601 week number
    return $dateWeek->format('W');
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['event_date']))
{
    $event_date = $_GET['event_date'];
    list($day, $month, $year) = explode("/", $event_date);

    
    if (checkdate($month, $day, $year))
    {
        $formatted_date = "$year-$month-$day"; // For timestamp calculation
        $display_date = "$day/$month/$year";
        $weekNumber = getWeekNumber($formatted_date);

        $timestamp = strtotime($formatted_date);
        $dayOfWeek = date("l", $timestamp);  // Full weekday name (e.g., "Friday")
        $dayOfMonth = date("j", $timestamp); // Day of the month (e.g., "4")
        $monthName = date("F", $timestamp);  // Full month name (e.g., "May")

        // Define Swedish equivalents for weekdays and months
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
        
        // Get the Swedish names for the day of the week and month
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

print($timestamp_output);
?>