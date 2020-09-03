<?php

function cache_file() {
    // something to (hopefully) uniquely identify the resource
    $cache_key = md5($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . $_SERVER['QUERY_STRING']);
    $cache_dir = '/tmp/phpcache';

    return $cache_dir . '/' . $cache_key;
}

// if we have a cache file, deliver it
if( is_file( $cache_file = cache_file() ) ) {
    readfile( $cache_file );
    exit;
}

// cache via output buffering, with callback
ob_start( 'cache_output' );

//
// expensive processing happens here, along with page output.
//

function cache_output( $content ) {
    file_put_contents( cache_file(), $content );
    return $content;
}
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css" rel="stylesheet">
        <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>
        <?php
include("mconfig.php");
include("api/api-server2.php");
?>
<?php

// Start Playerranks 
$sqlTopHeli = "SELECT Name, HeliKills FROM playerranksdb
where HeliKills > 0
ORDER BY HeliKills desc limit 1";

$sqlTopHeliHits = "SELECT Name, HeliHits FROM playerranksdb
where HeliHits > 0
ORDER BY HeliHits desc limit 1";

$sqlTopStructuresBuilt = "SELECT Name, StructuresBuilt FROM playerranksdb
ORDER BY StructuresBuilt desc limit 1";

$sqlTopOnline = "SELECT Name, TimePlayed FROM playerranksdb
ORDER BY TimePlayed desc limit 1";

$result = $conn_ply_rnk_2->query($sqlTopHeli);
$data = $result->fetch_assoc();
$heliPlayer =  $data['Name'];
$heliTotalKills =  $data['HeliKills'];

$result = $conn_ply_rnk_2->query($sqlTopHeliHits);
$data = $result->fetch_assoc();
$heliHitsName =  $data['Name'];
$heliHitsTotal =  $data['HeliHits'];

$result = $conn_ply_rnk_2->query($sqlTopStructuresBuilt);
$data = $result->fetch_assoc();
$pname =  $data['Name'];
$StructuresBuilt =  $data['StructuresBuilt'];

$result = $conn_ply_rnk_2->query($sqlTopOnline);
$data = $result->fetch_assoc();
$timePlayedName =  $data['Name'];
$timePlayedTotal =  $data['TimePlayed'];

?>
        
            <div class="row start">
            <div class=""><pre><p><?php echo $srv2LastReset ?></p></pre></div><br />
            <!-- Start banner from rust-servers.info -->

            <!-- Insert Rust-servers.info banner here-->

            <!-- END banner from rust-servers.info -->
            <!-- Start API Data Battlemetrics - Rust-servers.net - Rust-Servers.info -->
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse card-success">
                    <div class="card-block bg-success">
                        <h6 class="text-uppercase">Players Online</h6>
                        <h1 class="display-4"><?php echo $server_players ?><?php echo "/" ?><?php echo $server_max_players ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse card-info">
                    <div class="card-block bg-info">
                        <h6 class="text-uppercase">Server Rank</h6>
                        <h1 class="display-4"><?php echo $server_rank ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse card-danger">
                    <div class="card-block bg-danger">
                        <h6 class="text-uppercase">uptime</h6>
                        <h1 class="display-6"><?php echo secondsToTime($server_uptime_battle); ?></h1>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse card-warning">
                    <div class="card-block bg-warning">
                        <h6 class="text-uppercase">Entities</h6>
                        <h1 class="display-4"><?php echo $server_entities; ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- END API Data Battlemetrics - Rust-servers.net - Rust-Servers.info -->
        <!-- Start PlayerRanks Top Player for Heli Kills, Heli Hits, Structures Built and Top Time Played -->
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse bg-faded">
                    <div class="card-block bg-faded">
                        <h6 class="text-uppercase">Top heli-kills</h6>
                        <h4 class="display-6">
                    <?php if ($heliTotalKills < "1") { echo "No data";} else { echo $heliPlayer; echo '<br>'; echo " <span class='badge badge2020' title='Total amount kills with this weapon'>$heliTotalKills</span>"; }?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse bg-faded">
                    <div class="card-block bg-faded">
                        <h6 class="text-uppercase">Top heli-hits</h6>
                        <h4 class="display-6">
                    <?php if ($heliHitsTotal < "1") { echo "No data";} else { echo $heliHitsName; echo '<br>'; echo " <span class='badge badge2020' title='Where players have most hits'>$heliHitsTotal</span>"; }?>
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse bg-faded">
                    <div class="card-block bg-faded">
                        <h6 class="text-uppercase">Top Structures Built</h6>
                        <h4 class="display-6"><?php if ($StructuresBuilt < "1") { echo "No data";} else { echo $pname; echo '<br>'; echo " <span class='badge badge2020' title='Total amount of kills with this weapon'>$StructuresBuilt</span>"; } ?></h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="card card-inverse bg-faded">
                    <div class="card-block bg-faded">
                        <h6 class="text-uppercase">Top time played</h6>
                        <h4 class="display-7"><?php if ($timePlayedTotal <= '00:00:00:00') { echo "No data";} else {  echo $timePlayedName; echo '<br>'; echo " <span class='badge badge2020' title='Total amount of time played'>$timePlayedTotal</span>"; } ?></h4>
                    </div>
                </div>
            </div>
        </div>
<!-- END PlayerRanks Top Player for Heli Kills, Heli Hits, Structures Built and Top Time Played -->

        <!-- Start PlayerRanks Kill Ratio Table -->
            <div class="row"> <div class="col-lg-6">
                <h3>Kill ratio</h3>
<?php

$sql = "SELECT `UserID`,`Name`,`PVPKills`,`KDR`,`Status` FROM playerranksdb
ORDER BY 3 desc limit 100";

$result = $conn_ply_rnk_2->query($sql);



echo " <div class='table-responsive'>";
echo "";
echo "";
echo "<table id='killratio' class='display compact table table-hover table-striped results '>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Name</th>";
echo "<th>PVPKills</th>";
echo "<th>KDR</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {

$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td><a href='http://steamcommunity.com/profiles/" . $row['UserID']. "' target='_blank'>" . $row['Name']. "</td>";
echo "<td>" . $row['PVPKills']. "</td>";
echo "<td>" . $row['KDR']. "</td>";
echo "</tr>";

}
echo "</tbody>";
echo "</table>";
echo "</div>";


?>
            </div>
            <!-- END PlayerRanks Kill Ratio Table -->
            <!-- Start PlayerRanks Death Ratio Table -->
            <div class="col-lg-6">
                <h3>
                    Death ratio
                </h3>
<?php

$sql = "SELECT `UserID`,`Name`, `Deaths`, `SDR`, `Status` FROM playerranksdb
ORDER BY 3 desc limit 100";

$result = $conn_ply_rnk_2->query($sql);

echo " <div class='table-responsive'>";
echo "";
echo "";
echo "<table id='deathratio' class='display compact table table-hover table-striped results '>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Name</th>";
echo "<th>Deaths</th>";
echo "<th>SDR</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {

$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td><a href='http://steamcommunity.com/profiles/" . $row['UserID']. "' target='_blank'>" . $row['Name']. "</td>";
echo "<td>" . $row['Deaths']. "</td>";
echo "<td>" . $row['SDR']. "</td>";
echo "</tr>";

}
echo "</tbody>";
echo "</table>";
echo "</div>";


?>
            </div>
        </div>
        <!-- END PlayerRanks Death Ratio Table -->
        <!-- Start PlayerRanks Time Played Table -->
        <div class="row">
            <div class="col-lg-6">
                <h3>Time Played</h3>
<?php

$sql = "SELECT `UserID`,`Name`, `TimePlayed`, `Status` FROM playerranksdb
ORDER BY 3 desc limit 100";

$result = $conn_ply_rnk_2->query($sql);

echo " <div class='table-responsive'>";
echo "<table id='timeplayed' class='table table-hover table-striped'>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Name</th>";
echo "<th>Time Played</th>";
echo "<th>Status</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {


$counter2 = $counter++;

echo "<tr>";
if ($row['Status'] == 'online'){ echo "<th class='success' scope='row'>$counter2</th>"; } else { echo "<th scope='row'>$counter2</th>"; }
if ($row['Status'] == 'online'){ echo "<td class='success'><a href='http://steamcommunity.com/profiles/" . $row['UserID']. "' target='_blank'>" . $row['Name']. "</a></td>"; } else { echo "<td><a href='http://steamcommunity.com/profiles/" . $row['UserID']. "' target='_blank'>" . $row['Name']. "</a></td>"; }
if ($row['Status'] == 'online'){ echo "<td class='success'>".$row['TimePlayed']."</td>"; } else { echo "<td>".$row['TimePlayed']."</td>"; }
if ($row['Status'] == 'online'){ echo "<td class='success'>".$row['Status']."</td>"; } else { echo "<td>".$row['Status']."</td>"; }
echo "</tr>";

}
echo "</tbody>";
echo "</table>";
echo "</div>";

?>
            </div>
            <!-- END PlayerRanks Time Played Table -->
            <!-- Start PlayerRanks Structures Table -->
            <div class="col-lg-6">
                <h3>
                    Structures
                </h3>
<?php

$sql = "SELECT `UserID`,`Name`,`StructuresBuilt`,`StructuresUpgraded` FROM playerranksdb
ORDER BY 3 desc limit 100";

$result = $conn_ply_rnk_2->query($sql);

echo " <div class='table-responsive'>";
echo "";
echo "";
echo "<table id='Structures' class='display compact table table-hover table-striped results '>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Name</th>";
echo "<th>Built</th>";
echo "<th>Upgraded</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {

$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td><a href='http://steamcommunity.com/profiles/" . $row['UserID']. "' target='_blank'>" . $row['Name']. "</td>";
echo "<td>" . $row['StructuresBuilt']. "</td>";
echo "<td>" . $row['StructuresUpgraded']. "</td>";
echo "</tr>";

}
echo "</tbody>";
echo "</table>";
echo "</div>";
  
?>
          </div>
      </div>
      <!-- END PlayerRanks Structures Table -->
      <!-- Start PlayerRanks Top Players Table -->
      <div class="row">
          <div class="col-lg-12">
              <h3>
                  Top Players
              </h3>
<?php

$sql = "SELECT `UserID`,`Name`,`TimesWounded`,`ExplosivesThrown`,`ArrowsFired`,`BulletsFired`,`RocketsLaunched`,`TimesHealed` FROM playerranksdb
ORDER BY TimePlayed desc limit 100";

$result = $conn_ply_rnk_2->query($sql);

echo " <div class='table-responsive'>";
echo "";
echo "";
echo "<table id='topplayers' class='display compact table table-hover table-striped results '>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Name</th>";
echo "<th>TimesWounded</th>";
echo "<th>ExplosivesThrown</th>";
echo "<th>ArrowsFired</th>";
echo "<th>BulletsFired</th>";
echo "<th>RocketsLaunched</th>";
echo "<th>TimesHealed</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {

$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td><a href='http://steamcommunity.com/profiles/" . $row['UserID']. "' target='_blank'>" . $row['Name']. "</td>";
echo "<td>" . $row['TimesWounded']. "</td>";
echo "<td>" . $row['ExplosivesThrown']. "</td>";
echo "<td>" . $row['ArrowsFired']. "</td>";
echo "<td>" . $row['BulletsFired']. "</td>";
echo "<td>" . $row['RocketsLaunched']. "</td>";
echo "<td>" . $row['TimesHealed']. "</td>";
echo "</tr>";

}
echo "</tbody>";
echo "</table>";
echo "</div>";
?>
        </div>
      </div>
      <!-- END PlayerRanks Top Players Table -->
      <!-- Start PlayerRanks Top Clan Table -->
      <div class="row">
          <div class="col-lg-12">
              <h3>
                  Top Clan
              </h3>
<?php

$sql = "SELECT Clan, SUM(PVPKills) AS ClanPVPKills, SUM(Deaths) as ClanDeaths, SUM(HeadShots) AS ClanHeadshots, SUM(BulletsFired) AS ClanBullets,SUM(RocketsLaunched) AS ClanRockets, 
SUM(ExplosivesThrown) AS ClanExplosives, SUM(HeliKills) AS ClanHeliKills, SUM(APCKills) AS ClanAPCKills FROM playerranksdb GROUP BY Clan ORDER BY ClanPVPKills DESC";

$result = $conn_ply_rnk_2->query($sql);

echo " <div class='table-responsive'>";
echo "";
echo "";
echo "<table id='clan' class='display compact table table-hover table-striped results '>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Clan</th>";
echo "<th>PVPKills</th>";
echo "<th>Deaths</th>";
echo "<th>HeadShots</th>";
echo "<th>Bullets Fired</th>";
echo "<th>Rockets Launched</th>";
echo "<th>Explosives Thrown</th>";
echo "<th>Heli Kills</th>";
echo "<th>APC Kills</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {

$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td>" . $row['Clan']. "</td>";
echo "<td>" . $row['ClanPVPKills']. "</td>";
echo "<td>" . $row['ClanDeaths']. "</td>";
echo "<td>" . $row['ClanHeadshots']. "</td>";
echo "<td>" . $row['ClanBullets']. "</td>";
echo "<td>" . $row['ClanRockets']. "</td>";
echo "<td>" . $row['ClanExplosives']. "</td>";
echo "<td>" . $row['ClanHeliKills']. "</td>";
echo "<td>" . $row['ClanAPCKills']. "</td>";
echo "</tr>";

}
echo "</tbody>";
echo "</table>";
echo "</div>";

$conn_ply_rnk_2->close();
?>
          </div>
      </div>
      <!-- END PlayerRanks Top Clan Table -->
      <script>
          // Disable search and ordering by default
          $.extend($
              .fn
              .dataTable
              .defaults, {
              searching: true,
              ordering: false,
              pagingType: "simple",
              bLengthChange: false
          });
          $(document).ready(function () {
              $('#killratio').DataTable({ordering: true})
          });
          $(document).ready(function () {
              $('#deathratio').DataTable({ordering: true})
          });
          $(document).ready(function () {
              $('#timeplayed').DataTable({ordering: true})
          });
          $(document).ready(function () {
              $('#Structures').DataTable({ordering: true})
          });
          $(document).ready(function () {
              $('#topplayers').DataTable({ordering: true})
          });
          $(document).ready(function () {
              $('#clan').DataTable({ordering: true})
          });
      </script>
      <script src="js/bootstrap.min.js"></script>