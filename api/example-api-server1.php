<?php

// rust-servers.net api details
// Remember to add your API key in the end of the $url after =
// this is my main to get name, players and rank.
$url = "https://rust-servers.net/api/?object=servers&element=detail&key=";

$json = file_get_contents($url);
$json_data = json_decode($json, true);

$server_name = $json_data["name"];
$server_players = $json_data["players"];
$server_rank = $json_data["rank"];
// End rust-servers.net

// rust-servers.info below
// you will need to also add your server here: https://rust-servers.info/add.html
// info api - to get entities
$url_info = "https://api.rust-servers.info/info/106"; // use your serverID
$json_info = file_get_contents($url_info);
$json_info_data = json_decode($json_info, true);

$server_entities = $json_info_data['entities'];
// $server_rank = $json_data["rating"]; // uncomment this if you want to only use rust-servers.info
// End info api

// status api - to get uptime
$url_status = "https://api.rust-servers.info/status/106"; // use your serverID
$json_status = file_get_contents($url_status);
$json_status_data = json_decode($json_status, true);

$server_uptime = $json_status_data["uptime"];
// $server_name = $json_data["name"]; // uncomment this if you want to only use rust-servers.info
// $server_players = $json_data["players"]; // uncomment this if you want to only use rust-servers.info
// End status api

?>
