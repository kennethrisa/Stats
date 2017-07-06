<?php

// Example how to get players stats from using RustAdmin rcon tool to a webpage:
// Open link in webbrowser: http://localhost:8888/getPlayersGlobalStats
// save this as getPlayersGlobalStats.json
$string = file_get_contents('getPlayersGlobalStats.json');
$json = json_decode($string, true);
$json_encode = json_encode($json);

echo "<table><tr>";
// echo "<th>PlayerID</th>";
echo "
      <th>PlayerName</th>
      <th>PVP Kills</th>
      <th>PVP Deaths</th>
      <th>PVE Deaths</th>
      </tr>
      <tr>";

foreach ($json['players'] as $player)
{

    // echo "<td>" . $player['PlayerID'] ."</td>";
    echo "<td>" . $player['PlayerName'] ."</td>";
    echo "<td>" . count($player['PlayerKills']) ."</td>";
    echo "<td>" . count($player['PlayerDeathsPVP']) ."</td>";
    echo "<td>" . count($player['PlayerDeathsPVE']) ."</td>";
    echo "<tr>";

};

echo "</table>";

?>
