<?php

// rust-servers.net api details
// Remember to add your API key in the end of the $url after =
$url = "https://rust-servers.net/api/?object=servers&element=detail&key=";

$json = file_get_contents($url);
$json_data = json_decode($json, true);

$server_name = $json_data["name"];
$server_players = $json_data["players"];
$server_rank = $json_data["rank"];

?>
