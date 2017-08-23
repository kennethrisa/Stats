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
<link href="//cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<?php
include("mconfig.php");
include("api/api-server1.php");
?>
<?php

$sqlTopHeli = "SELECT Name, HeliKills FROM playerranksdb2
where HeliKills > 0
ORDER BY HeliKills desc limit 1";

$sqlTopHeliHits = "SELECT Name, HeliHits FROM playerranksdb2
where HeliHits > 0
ORDER BY HeliHits desc limit 1";

$sqlTopStructuresBuilt = "SELECT Name, StructuresBuilt FROM playerranksdb2
ORDER BY StructuresBuilt desc limit 1";

$sqlTopOnline = "SELECT Name, TimePlayed FROM playerranksdb2
ORDER BY TimePlayed desc limit 1";

$result = $conn->query($sqlTopHeli);
$data = $result->fetch_assoc();
$heliPlayer =  $data['Name'];
$heliTotalKills =  $data['HeliKills'];

$result = $conn->query($sqlTopHeliHits);
$data = $result->fetch_assoc();
$heliHitsName =  $data['Name'];
$heliHitsTotal =  $data['HeliHits'];

$result = $conn->query($sqlTopStructuresBuilt);
$data = $result->fetch_assoc();
$pname =  $data['Name'];
$StructuresBuilt =  $data['StructuresBuilt'];

$result = $conn->query($sqlTopOnline);
$data = $result->fetch_assoc();
$timePlayedName =  $data['Name'];
$timePlayeTotal =  $data['TimePlayed'];

?>

<div class=""><p><b><img src="https://via.placeholder.com/350x150" alt="Your logo here" class="img-rounded"> </b></p></div>

<div class=""><pre><p><?php echo $srv1LastReset ?></p></pre></div><br />

<!-- row 1 -->
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="card card-inverse card-success">
            <div class="card-block bg-success">
                <div class="rotate">
                    <i class="fa fa-user fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Players Online</h6>
	<h1 class="display-4"><?php echo $server_players ?></h1>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-inverse card-info">
            <div class="card-block bg-info">
                <div class="rotate">
                    <i class="fa fa-list fa-5x"></i>
                </div><!-- Total users in database -->
                <h6 class="text-uppercase">Server Rank</h6>
	<h1 class="display-4"><?php echo $server_rank ?></h1>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-inverse card-danger">
            <div class="card-block bg-danger">
                <div class="rotate">
                    <i class="fa fa-deviantart fa-5x"></i>
                </div>
                <h6 class="text-uppercase">uptime</h6>
                <h1 class="display-4"><?php echo $server_uptime; ?></h1>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6">
        <div class="card card-inverse card-warning">
            <div class="card-block bg-warning">
                <div class="rotate">
                    <i class="fa fa-share fa-5x"></i>
                </div>
                <h6 class="text-uppercase">Entities</h6>
                <h1 class="display-4"><?php echo $server_entities; ?></h1>
            </div>
        </div>
    </div>
</div>
<!--end row 1-->
<!--row 2-->
<div class="row">
          <div class="col-md-3 col-sm-6">
              <div class="card card-inverse bg-faded">
                  <div class="card-block bg-faded">
                      <div class="rotate">
                          <i class="fa fa-user fa-5x"></i>
                      </div>
                      <h6 class="text-uppercase">Top heli-kills</h6>
				<h4 class="display-6"><?php if ($heliTotalKills < "1") { echo "No data";} else { echo $heliPlayer; echo " <span class='badge' title='Total amount kills with this weapon'>$heliTotalKills</span>"; }?></h4>
                  </div>
              </div>
          </div>
          <div class="col-md-3 col-sm-6">
						<div class="card card-inverse bg-faded">
								<div class="card-block bg-faded">
                      <div class="rotate">
                          <i class="fa fa-list fa-5x"></i>
                      </div><!-- Total users in database -->
                      <h6 class="text-uppercase">Top heli-hits</h6>
				<h4 class="display-6"><?php if ($heliHitsTotal < "1") { echo "No data";} else { echo $heliHitsName; echo " <span class='badge' title='Where players have most hits'>$heliHitsTotal</span>"; }?></h4>
                  </div>
              </div>
          </div>
          <div class="col-md-3 col-sm-6">
						<div class="card card-inverse bg-faded">
								<div class="card-block bg-faded">
                      <div class="rotate">
                          <i class="fa fa-deviantart fa-5x"></i>
                      </div>
                      <h6 class="text-uppercase">Top StructuresBuilt</h6>
                      <h4 class="display-6"><?php echo $pname; echo '<br>'; echo " <span class='badge' title='Total amount of kills with this weapon'>$StructuresBuilt</span>"; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-md-3 col-sm-6">
						<div class="card card-inverse bg-faded">
								<div class="card-block bg-faded">
                      <div class="rotate">
                          <i class="fa fa-share fa-5x"></i>
                      </div>
                      <h6 class="text-uppercase">Top time played</h6>
                      <h4 class="display-7"><?php echo $timePlayedName; echo " <span class='badge' title='Total amount of time played'>$timePlayeTotal</span>"; ?></h4>
                  </div>
              </div>
          </div>
      </div>
      <!-- end row 2-->

<div class="row">
    <div class="col-lg-6">
        <h3>Kill ratio</h3>
<?php
$sql = "SELECT `UserID`,`Name`,`PVPKills`,`KDR`,`Status` FROM playerranksdb2
ORDER BY 3 desc limit 100";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
echo " <div class='table-responsive'>";
echo "";
echo "";
echo "<table id='example' class='display compact table table-hover table-striped results '>";
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
}

?>
    </div>
<div class="col-lg-6">
    <h3>
        Death ratio
    </h3>
    <?php
$sql = "SELECT `UserID`,`Name`, `Deaths`, `SDR`, `Status` FROM playerranksdb2
ORDER BY 3 desc limit 100";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
echo " <div class='table-responsive'>";
echo "";
echo "";
echo "<table id='example2' class='display compact table table-hover table-striped results '>";
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
}

?>
</div>
</div>


<div class="row">
    <div class="col-lg-6">
        <h3>Time Played</h3>
<?php

$sql = "SELECT `UserID`,`Name`, `TimePlayed`, `Status` FROM playerranksdb2
ORDER BY 3 desc limit 100";
$result = $conn->query($sql);

// output data of each row
echo " <div class='table-responsive'>";
echo "<table id='example3' class='table table-hover table-striped'>";
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
  <div class="col-lg-6">
      <h3>
          Structures
      </h3>
      <?php
  $sql = "SELECT `UserID`,`Name`,`StructuresBuilt`,`StructuresUpgraded` FROM playerranksdb2
  ORDER BY 3 desc limit 100";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
  echo " <div class='table-responsive'>";
  echo "";
  echo "";
  echo "<table id='StructuresBuilt' class='display compact table table-hover table-striped results '>";
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
  }

  ?>
  </div>
  <!-- end top StructuresBuilt -->
</div>

<div class="row">
  <div class="col-lg-12">
      <h3>
          Top
      </h3>
      <?php
  $sql = "SELECT `UserID`,`Name`,`TimesWounded`,`ExplosivesThrown`,`ArrowsFired`,`BulletsFired`,`RocketsLaunched`,`TimesHealed` FROM playerranksdb2
  ORDER BY TimePlayed desc limit 100";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
  echo " <div class='table-responsive'>";
  echo "";
  echo "";
  echo "<table id='example4' class='display compact table table-hover table-striped results '>";
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
  }
$conn->close();
  ?>
</div>
</div>
  <!-- end row -->
<script>
// Disable search and ordering by default
$.extend( $.fn.dataTable.defaults, {
    searching: true,
    ordering:  false,
    pagingType: "simple",
	bLengthChange: false
} );

$(document).ready(function() {
    $('#example').DataTable({
	ordering: true
	})
} );

$(document).ready(function() {
    $('#example2').DataTable({
	ordering: true
	})
} );

$(document).ready(function() {
    $('#example3').DataTable({
	ordering: true
	})
} );

$(document).ready(function() {
    $('#StructuresBuilt').DataTable({
	ordering: true
	})
} );

$(document).ready(function() {
    $('#example4').DataTable({
	ordering: true
	})
} );
$(document).ready(function() {
    $('#example5').DataTable({
	ordering: true
	})
} );
</script>
<script src="js/bootstrap.min.js"></script>
