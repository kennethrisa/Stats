<?php
include("mconfig.php");
include("apiconfig.php")
?>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.10/css/dataTables.bootstrap.min.css" rel="stylesheet">
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>

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
<?php

$sqltotalusers = "SELECT COUNT(id) as total FROM stats_player";

$sqltotalkills = "select COUNT(id) as kills FROM stats_player_kill";

$sqltotaldeath = "select COUNT(id) as death FROM stats_player_death where cause not in('SUICIDE','BITE')";

	// Total users connect to this server
	$result = $conn->query($sqltotalusers);
	$data = $result->fetch_assoc();
	$Total =  $data['total'];

	$result = $conn->query($sqltotalkills);
	$data = $result->fetch_assoc();
	$TotalKills =  $data['kills'];

	$result = $conn->query($sqltotaldeath);
	$data = $result->fetch_assoc();
	$TotalDeath =  $data['death'];

?>
<section id="intro" class="intro-section">
        <div class="container">
			<!-- top 1 Row
        <div class="row">
            <div class="col-lg-4 col-sm-6 text-center">
                <h3>Top online</h3>
                <p>test</p>
            </div>
            <div class="col-lg-4 col-sm-6 text-center">
                <h3>Top kill's</h3>
                <p>Test</p>
            </div>
        </div>
        <hr>	-->

		<div class=""><p><b><?php echo $server_name ?> </b></p></div>

		<div class=""><pre><p><?php echo $last_reset ?></p></div><br />

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
                                <i class="fa fa-list fa-4x"></i>
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
                            <h6 class="text-uppercase">Total kills</h6>
                            <h1 class="display-4"><?php echo $TotalKills ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="card card-inverse card-warning">
                        <div class="card-block bg-warning">
                            <div class="rotate">
                                <i class="fa fa-share fa-5x"></i>
                            </div>
                            <h6 class="text-uppercase">Total deaths</h6>
                            <h1 class="display-4"><?php echo $TotalDeath ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <!--/row-->

            <div class="row">
                <div class="col-lg-6">
                    <h3>Kill ratio</h3>
				<?php
				$sql = "SELECT p.name as name, count(k.killer) as killer FROM stats_player p, stats_player_kill k
						where p.id = k.killer
						group by killer
						order by 2 desc limit 100";

				$result = $conn->query($sql,$sql2);

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
				$sql = "SELECT p.name as name, count(d.count) as death FROM stats_player p, stats_player_death d
						where p.id = d.player and cause not in('SUICIDE')
						group by 1
						order by 2 desc limit 100";

				$result = $conn->query($sql,$sql2);

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

					$sql = "SELECT name, online_seconds FROM stats_player order by online_seconds desc limit 100";
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

    </section>


	    <script src="js/bootstrap.min.js"></script>
