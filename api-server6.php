<?php

// UPDATED SEPT 2020 BY P4R4NORMAL

// You shouldn't need to use other API's other than BattleMetrics
// They are there for you to use but in my opinion battlemetrics is the goto site for server data


// BATTLEMETRICS API  MAIN-API
$url_battle = "https://api.battlemetrics.com/servers/7834086"; // Change the SERVER ID 7834086 to your serverID

$json_battle = file_get_contents($url_battle);
$json_battle_data = json_decode($json_battle, true);

$server_name = $json_battle_data["data"]["attributes"]["name"];
$server_players = $json_battle_data["data"]["attributes"]["players"];
$server_max_players = $json_battle_data["data"]["attributes"]["maxPlayers"];
$server_rank = $json_battle_data["data"]["attributes"]["rank"];
$server_entities = $json_battle_data["data"]["attributes"]["details"]["rust_ent_cnt_i"];
$server_uptime_battle = $json_battle_data["data"]["attributes"]["details"]["rust_uptime"];

function secondsToTime($server_uptime_battle) {
    $dtF = new \DateTime('@0');
    $dtT = new \DateTime("@$server_uptime_battle");
    return $dtF->diff($dtT)->format('%ad %hh %imin');
}
// END OF BATTLEMETRICS API

//------------------------------------------------------------------------------------------------------------------

// RUST-SERVERS.NET API DETAILS
// REMEMBER TO ADD YOU API KEY AT THE END OF THE = SIGN IN THE $URL VARIABLE 
// GET NAME, PLAYERS, RANK

$url_rs = "https://rust-servers.net/api/?object=servers&element=detail&key=";

$json_rs = file_get_contents($url_rs);
$json_rs_data = json_decode($json_rs, true);

// $server_name = $json_rs_data["name"];
// $server_players = $json_rs_data["players"];
// $server_rank = $json_rs_data["rank"];

// END RUST-SERVERS.NET API DETAILS

//-------------------------------------------------------------------------------------------------------------------

// RUST-SERVERS.INFO API DETAILS
// YOU WILL NEED TO ADD YOU SERVER TO THEIR DATABASE IN ORDER TO GET A SERVER ID
// YOU CAN ADD YOUR SERVER HERE --- https://rust-servers.info/add.html
// GET NAME, PLAYERS, MAX-PLAYERS, ENTITIES, RATING, AND UPTIME

$url_info = "https://api.rust-servers.info/info/106"; // Replace 106 with your own serverID

$json_info = file_get_contents($url_info);
$json_info_data = json_decode($json_info, true);

// $server_name = $json_info_data['hostname'];
// $server_players = $json_info_data["players_cur"];
// $server_max_players = $json_info_data["players_max"];
// $server_entities = $json_info_data['entities'];
// $server_rank = $json_info_data["rating"]; // uncomment this if you want to the rating instead of rank
// $server_uptime = $json_info_data["uptime"];

// END RUST-SERVERS.INFO API DETAILS
?>