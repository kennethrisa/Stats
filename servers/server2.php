rust2.<?php

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
<link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>
<?php
include("../mconfig.php");
include("api/api-server2.php");
?>
<?php

$sqlTopWeapon = "SELECT weapon, count(weapon) as total FROM rust2.stats_player_kill
group BY weapon
order by 2 desc
limit 1";

$sqlTopBodypart = "SELECT bodypart, count(bodypart) as total FROM rust2.stats_player_kill
group BY bodypart
order by 2 desc
limit 1";

$sqlTopPlayerAndWeapon = "select p.name as name, k.weapon, count(k.weapon) as weapontotal FROM rust2.stats_player p, rust2.stats_player_kill k
where p.id = k.killer
group BY k.weapon, p.name
order by 3 desc
limit 1";

$sqlTopOnline = "SELECT name FROM rust2.stats_player order by online_seconds desc limit 1";

$result = $conn->query($sqlTopWeapon);
$data = $result->fetch_assoc();
$weapon =  $data['weapon'];
$weapontotal =  $data['total'];

$result = $conn->query($sqlTopBodypart);
$data = $result->fetch_assoc();
$bodypart =  $data['bodypart'];
$bodyparttotal =  $data['total'];

$result = $conn->query($sqlTopPlayerAndWeapon);
$data = $result->fetch_assoc();
$pname =  $data['name'];
$pweapon =  $data['weapon'];
$pweapontotal =  $data['weapontotal'];

$result = $conn->query($sqlTopOnline);
$data = $result->fetch_assoc();
$toponline =  $data['name'];

?>

<div class=""><p><b><?php echo $server_name ?> </b></p></div>

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
                      <h6 class="text-uppercase">Top weapon</h6>
				<h4 class="display-6"><?php echo $weapon; echo " <span class='badge' title='Total amount kills with this weapon'>$weapontotal</span>"; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-md-3 col-sm-6">
						<div class="card card-inverse bg-faded">
								<div class="card-block bg-faded">
                      <div class="rotate">
                          <i class="fa fa-list fa-5x"></i>
                      </div><!-- Total users in database -->
                      <h6 class="text-uppercase">Top bodypart hits</h6>
				<h4 class="display-6"><?php echo $bodypart; echo " <span class='badge' title='Where players have most hits'>$bodyparttotal</span>"; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-md-3 col-sm-6">
						<div class="card card-inverse bg-faded">
								<div class="card-block bg-faded">
                      <div class="rotate">
                          <i class="fa fa-deviantart fa-5x"></i>
                      </div>
                      <h6 class="text-uppercase">Top player with top weapon used</h6>
                      <h4 class="display-6"><?php echo $pname; echo '<br>'; echo $pweapon; echo " <span class='badge' title='Total amount of kills with this weapon'>$pweapontotal</span>"; ?></h4>
                  </div>
              </div>
          </div>
          <div class="col-md-3 col-sm-6">
						<div class="card card-inverse bg-faded">
								<div class="card-block bg-faded">
                      <div class="rotate">
                          <i class="fa fa-share fa-5x"></i>
                      </div>
                      <h6 class="text-uppercase">Top Online</h6>
                      <h4 class="display-7"><?php echo $toponline; ?></h4>
                  </div>
              </div>
          </div>
      </div>
      <!-- end row 2-->

<div class="row">
    <div class="col-lg-6">
        <h3>Kill ratio</h3>
<?php
$sql = "SELECT p.name as name, count(k.killer) as killer FROM rust2.stats_player p, rust2.stats_player_kill k
where p.id = k.killer
group by killer
order by 2 desc limit 100";

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
echo "<th>Kills</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {

$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td>" . $row['name']. "</td>";
echo "<td>" . $row['killer']. "</td>";
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
$sql = "SELECT p.name as name, count(k.victim) as death FROM rust2.stats_player p, rust2.stats_player_kill k
		where p.id = k.victim
		group by victim
		order by 2 desc limit 100";

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
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {

$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td>" . $row['name']. "</td>";
echo "<td>" . $row['death']. "</td>";
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
        <h3>Top Online</h3>
<?php

//get_hours
function get_hours($seconds)
{
$return = '';

$hours = (int)($seconds / 3600);
$minutes = (int)(($seconds - $hours * 3600) / 60);

if( $hours > 0 )
	{
		$return .= $hours . 'h';
	}
if( $minutes > 0 )
	{
	if( $hours > 0 )
	{
		$return .= ' ';
	}
	$return .= $minutes . 'm';
	}
if( empty($return) )
	return '0m';
else
	return $return;
}

$sql = "SELECT name, online_seconds FROM rust2.stats_player order by online_seconds desc limit 100";
$result = $conn->query($sql);

// output data of each row
echo " <div class='table-responsive'>";
echo "<table id='example3' class='table table-hover table-striped'>";
echo "<thead>";
echo "<tr>";
echo "<th>#</th>";
echo "<th>Name</th>";
echo "<th>Total Online</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

$counter = 1;

while($row = $result->fetch_assoc()) {


$counter2 = $counter++;

echo "<tr>";
echo "<th scope='row'>$counter2</th>";
echo "<td>" . $row['name']. "</a></td>";
echo "<td>".get_hours($row['online_seconds'])."</td>";
echo "</tr>";



}
echo "</tbody>";
echo "</table>";
echo "</div>";
$conn->close();
?>
    </div>
</div>

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
</script>
<script src="js/bootstrap.min.js"></script>
