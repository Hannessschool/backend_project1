<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>