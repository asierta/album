<?php
$servername = getenv('IP');
$username = getenv('C9_USER');
$password = "";
$dbport = 3306;
// Create connection
$mysqli = new mysqli($servername, $username, $password, "album", $dbport);
?>