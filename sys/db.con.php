<?php
$serverName = "localhost";
$DBUName = "root";
$DBPass = "root";
$DBName = "omargram";


$conn = mysqli_connect($serverName, $DBUName, $DBPass, $DBName);
if (!$conn) {
    die("ERROR: " . mysqli_connect_error());
}