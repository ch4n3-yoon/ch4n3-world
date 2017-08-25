<?php

/* Database Information for connecting */
$DBserver = "localhost";
$username = "****";
$password = "****";
$database = "****";

/* Create MySQL for object */
$mysqli = new mysqli($DBserver, $username, $password, $database);
$mysqli->set_charset('utf8');

/* Create MySQL for common */
$conn = $mysqli_connect($DBserver, $username, $password, $database);
mysqli_query($conn, "SET CHARSET UTF8");

?>
