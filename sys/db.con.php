<?php
$serverName = "sql110.epizy.com";
$DBUName = "epiz_34224806";
$DBPass = "AdZPmNelXAM";
$DBName = "epiz_34224806_omargram";


$conn = mysqli_connect($serverName, $DBUName, $DBPass, $DBName);
if (!$conn) {
    die("ERROR: " . mysqli_connect_error());
}