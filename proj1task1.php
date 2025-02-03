<?php
session_start();
$username = "eerolaha";

setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
if(!isset($_COOKIE[$cookie_name]))
{
    print("Cookie named " . $cookie_name . " is not set!");
}
else 
{
    print("Cookie " . $cookie_name . " is set!");
    print("Value is: " . $_COOKIE[$cookie_name]);
}

$userIP = $_SERVER['REMOTE_ADDR'];
$serverName = $_SERVER['SERVER_NAME'];
$serverTimezeone = date_default_timezone_get();

$cookie_name = "username";
$cookie_value = "eerolaha";
setcookie($cookie_name, $cookie_value, time()+(86400 * 30), "/");
if(!isset($_COOKIE[$cookie_name]))
{
    print("Cookie named " . $cookie_name . " is not set!");
}
else
{
    print("Cookie ".$cookie_name. " is set!<br>");
    print("Value is: ".$_COOKIE[$cookie_name]. "<br>");
}
?>
