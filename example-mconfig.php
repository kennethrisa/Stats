<?php

// Database variables
$servername = "localhost";
$port = "3306";
$username = "root";
$password = "password";
$dbname = "rust";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, $port);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Site last reset date:
$srv1LastReset = "<b>Last stats reset time:</b> 03.07.2017";
$srv2LastReset = "<b>Last stats reset time:</b> 03.07.2017";

$siteName = "Your Site Name";

?>
