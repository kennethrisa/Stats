<?php

// Database variables
$servername = "0.0.0.0";
$username = "database_user";
$password = "password";
$dbname = "database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Site last reset date:
$last_reset = "Last stats reset time: 03.02.2017";

$siteName = "Altirust.no";

?>
