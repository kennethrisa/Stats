<?php

// Updated SEPT 2020 by P4R4NORM4L
// SUPPORTS UP TO 6 SERVERS

$siteName = "Stats.com"; // Your site name 
$siteURL = "https://www.battlemetrics.com/"; // Your main site url 
$siteFavicon = "https://imgur.com/p0KS9wL.png"; // change your favicon here

//-----------------------------------------------------------------------------------------

// Start of Server 1 Database configs

// Server 1 - playerRanks - 1
// Theses settings must match your playerRanks plugin config
$servername_ply_rnk_1 = "localhost";
$port_ply_rnk_1 = "3306";
$username_ply_rnk_1 = "dbusername";
$password_ply_rnk_1 = "mydbpassword";
$dbname_ply_rnk_1 = "dbname"; 

// Connection - PlayerRanks - 1

// Create connection
$conn_ply_rnk_1 = new mysqli($servername_ply_rnk_1, $username_ply_rnk_1, $password_ply_rnk_1, $dbname_ply_rnk_1, $port_ply_rnk_1);
// Check connection
if ($conn_ply_rnk_1->connect_error) {
    die("Connection failed: " . $conn_ply_rnk_1->connect_error);
}

// Server 1 - SQLStats - 1 
// Remove line 29 and 44 to use SQL Stats DB
/*
$servername_sql_stats_1 = "localhost";
$port_sql_stats_1 = "3306";
$username_sql_stats_1 = "SQLRanksUsername1";
$password_sql_stats_1 = "mypassword";
$dbname_sql_stats_1 = "SQLRanksDatabaseName1";

// Connection - SQLStats - 1

// Create connection
$conn_sql_stats_1 = new mysqli($servername_sql_stats_1, $username_sql_stats_1, $password_sql_stats_1, $dbname_sql_stats_1, $port_sql_stats_1);

if ($conn_sql_stats_1->connect_error) {
   die("Connection failed: " . $conn_sql_stats_1->connect_error);
}
*/
// Manual settings for Stats Reset
$srv1LastReset = "<b>Last stats reset time:</b> 08/20";

// End of Server 1

//-----------------------------------------------------------------------------------------

// Remove lines 58 and 94 to use SERVER 2

// Start of Server 2 Database configs

// Server 2 - playerRanks - 2

// Theses settings must match your playerRanks plugin config

/*
$servername_ply_rnk_2 = "localhost";
$port_ply_rnk_2 = "3306";
$username_ply_rnk_2 = "playerRanksdb2";
$password_ply_rnk_2 = "mypassword";
$dbname_ply_rnk_2 = "playerRanksdb2"; 

// Connection - PlayerRanks - 2


$conn_ply_rnk_2 = new mysqli($servername_ply_rnk_2, $username_ply_rnk_2, $password_ply_rnk_2, $dbname_ply_rnk_2, $port_ply_rnk_2);

if ($conn_ply_rnk_2->connect_error) {
    die("Connection failed: " . $conn_ply_rnk_2->connect_error);
}

// Server 2 - SQLStats - 2 

$servername_sql_stats_2 = "localhost";
$port_sql_stats_2 = "3306";
$username_sql_stats_2 = "SQLRanksUsername2";
$password_sql_stats_2 = "mypassword";
$dbname_sql_stats_2 = "SQLRanksDatabaseName2";

// Connection - SQLStats - 2

 $conn_sql_stats_2 = new mysqli($servername_sql_stats_2, $username_sql_stats_2, $password_sql_stats_2, $dbname_sql_stats_2, $port_sql_stats_2);

 if ($conn_sql_stats_2->connect_error) {
     die("Connection failed: " . $conn_sql_stats_2->connect_error);
 }

// Manual settings for Stats Reset
$srv2LastReset = "<b>Last stats reset time:</b> 08/20";

// End of Server 2
*/
//-----------------------------------------------------------------------------------------

// Remove lines 105 and 142 to use SERVER 3

// Start of Server 3 Database configs

// Server 3 - playerRanks - 3
// Theses settings must match your playerRanks plugin config
/*
$servername_ply_rnk_3 = "localhost";
$port_ply_rnk_3 = "3306";
$username_ply_rnk_3 = "playerRanksdb3";
$password_ply_rnk_3 = "mypassword";
$dbname_ply_rnk_3 = "playerRanksdb3"; 

// Connection - PlayerRanks - 3

// Create connection
$conn_ply_rnk_3 = new mysqli($servername_ply_rnk_3, $username_ply_rnk_3, $password_ply_rnk_3, $dbname_ply_rnk_3, $port_ply_rnk_3);
// Check connection
if ($conn_ply_rnk_3->connect_error) {
    die("Connection failed: " . $conn_ply_rnk_3->connect_error);
}

// Server 3 - SQLStats - 3 

$servername_sql_stats_3 = "localhost";
$port_sql_stats_3 = "3306";
$username_sql_stats_3 = "SQLRanksUsername3";
$password_sql_stats_3 = "mypassword";
$dbname_sql_stats_3 = "SQLRanksDatabaseName3";

// Connection - SQLStats - 3

// Create connection
$conn_sql_stats_3 = new mysqli($servername_sql_stats_3, $username_sql_stats_3, $password_sql_stats_3, $dbname_sql_stats_3, $port_sql_stats_3);
// Check connection
if ($conn_sql_stats_3->connect_error) {
    die("Connection failed: " . $conn_sql_stats_3->connect_error);
}

// Manual settings for Stats Reset
$srv3LastReset = "<b>Last stats reset time:</b> 08/20";

// End of Server 3
*/
//-----------------------------------------------------------------------------------------

// Remove lines 151 and 188 to use SERVER 4

// Start of Server 4 Database configs

// Server 4 - playerRanks - 4
// Theses settings must match your playerRanks plugin config
/*
$servername_ply_rnk_4 = "localhost";
$port_ply_rnk_4 = "3306";
$username_ply_rnk_4 = "playerRanksdb4";
$password_ply_rnk_4 = "mypassword";
$dbname_ply_rnk_4 = "playerRanksdb4"; 

// Connection - PlayerRanks - 4

// Create connection
$conn_ply_rnk_4 = new mysqli($servername_ply_rnk_4, $username_ply_rnk_4, $password_ply_rnk_4, $dbname_ply_rnk_4, $port_ply_rnk_4);
// Check connection
if ($conn_ply_rnk_4->connect_error) {
    die("Connection failed: " . $conn_ply_rnk_4->connect_error);
}

// Server 4 - SQLStats - 4 

$servername_sql_stats_4 = "localhost";
$port_sql_stats_4 = "3306";
$username_sql_stats_4 = "SQLRanksUsername4";
$password_sql_stats_4 = "mypassword";
$dbname_sql_stats_4 = "SQLRanksDatabaseName4";

// Connection - SQLStats - 4

// Create connection
$conn_sql_stats_4 = new mysqli($servername_sql_stats_4, $username_sql_stats_4, $password_sql_stats_4, $dbname_sql_stats_4, $port_sql_stats_4);
// Check connection
if ($conn_sql_stats_4->connect_error) {
    die("Connection failed: " . $conn_sql_stats_4->connect_error);
}

// Manual settings for Stats Reset
$srv4LastReset = "<b>Last stats reset time:</b> 08/20";

// End of Server 4
*/
//-----------------------------------------------------------------------------------------

// Remove lines 197 and 234 to use SERVER 5

// Start of Server 5 Database configs

// Server 5 - playerRanks - 5
// Theses settings must match your playerRanks plugin config
/*
$servername_ply_rnk_5 = "localhost";
$port_ply_rnk_5 = "3306";
$username_ply_rnk_5 = "playerRanksdb5";
$password_ply_rnk_5 = "mypassword";
$dbname_ply_rnk_5 = "playerRanksdb5"; 

// Connection - PlayerRanks - 5

// Create connection
$conn_ply_rnk_5 = new mysqli($servername_ply_rnk_5, $username_ply_rnk_5, $password_ply_rnk_5, $dbname_ply_rnk_5, $port_ply_rnk_5);
// Check connection
if ($conn_ply_rnk_5->connect_error) {
    die("Connection failed: " . $conn_ply_rnk_5->connect_error);
}

// Server 5 - SQLStats - 5 

$servername_sql_stats_5 = "localhost";
$port_sql_stats_5 = "3306";
$username_sql_stats_5 = "SQLRanksUsername5";
$password_sql_stats_5 = "mypassword";
$dbname_sql_stats_5 = "SQLRanksDatabaseName5";

// Connection - SQLStats - 5

// Create connection
$conn_sql_stats_5 = new mysqli($servername_sql_stats_5, $username_sql_stats_5, $password_sql_stats_5, $dbname_sql_stats_5, $port_sql_stats_5);
// Check connection
if ($conn_sql_stats_5->connect_error) {
    die("Connection failed: " . $conn_sql_stats_5->connect_error);
}

// Manual settings for Stats Reset
$srv5LastReset = "<b>Last stats reset time:</b> 08/20";

// End of Server 5
*/
//-----------------------------------------------------------------------------------------

// Remove lines 243 and 280 to use SERVER 2

// Start of Server 6 Database configs

// Server 6 - playerRanks - 6
// Theses settings must match your playerRanks plugin config
/*
$servername_ply_rnk_6 = "localhost";
$port_ply_rnk_6 = "3306";
$username_ply_rnk_6 = "playerRanksdb6";
$password_ply_rnk_6 = "mypassword";
$dbname_ply_rnk_6 = "playerRanksdb6"; 

// Connection - PlayerRanks - 6

// Create connection
$conn_ply_rnk_6 = new mysqli($servername_ply_rnk_6, $username_ply_rnk_6, $password_ply_rnk_6, $dbname_ply_rnk_6, $port_ply_rnk_6);
// Check connection
if ($conn_ply_rnk_6->connect_error) {
    die("Connection failed: " . $conn_ply_rnk_6->connect_error);
}

// Server 6 - SQLStats - 6 

$servername_sql_stats_6 = "localhost";
$port_sql_stats_6 = "3306";
$username_sql_stats_6 = "SQLRanksUsername6";
$password_sql_stats_6 = "mypassword";
$dbname_sql_stats_6 = "SQLRanksDatabaseName6";

// Connection - SQLStats - 6

// Create connection
$conn_sql_stats_6 = new mysqli($servername_sql_stats_6, $username_sql_stats_6, $password_sql_stats_6, $dbname_sql_stats_6, $port_sql_stats_6);
// Check connection
if ($conn_sql_stats_6->connect_error) {
    die("Connection failed: " . $conn_sql_stats_6->connect_error);
}

// Manual settings for Stats Reset
$srv6LastReset = "<b>Last stats reset time:</b> 08/20";

// End of Server 6
*/
//----------------------------------------------------------------------------------------- 
?>