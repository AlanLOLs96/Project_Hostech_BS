<?php 
include_once('common_connection.php');
include_once('inmate_session.php');
include_once('_includes/php/functions.php');

$l_hist_fetch_sql_stmt = "select * from sick_leave_details where admno = '".$inmate_details['admno']."' order by seen desc" ;
$l_hist_sql = $connection->query($l_hist_fetch_sql_stmt);
$l_hist_details = $l_hist_sql->fetch_all(MYSQLI_ASSOC);


foreach ($l_hist_details as $arrayob => $novalue) 
	unset($l_hist_details[$arrayob]['admno']);

function printresult($arraylist){
	foreach ($arraylist as $arrayob => $novalue) {
		echo "<tr>";
		echo "<td>".$arraylist[$arrayob]['leave_no']."</td>";
		echo "<td>".$arraylist[$arrayob]['roomno']."</td>";
		echo "<td>".$arraylist[$arrayob]['date_applied']."</td>";
		echo "<td id = 'alignleft'>".$arraylist[$arrayob]['reason']."</td>";
		echo "<td>".$arraylist[$arrayob]['start_time']."</td>";
		echo "<td>".$arraylist[$arrayob]['end_time']."</td>";
		if ($arraylist[$arrayob]['seen'])
			echo '<td><button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span></button></td>' ;
		else
			echo '<td><button class="btn btn-success"><span class="glyphicon glyphicon-remove"></span></button></td>' ;
		echo "</tr>";
	}
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>

<body>
	<div class="container">
		<!--Navbar-->
		<?php include('_includes/page_inmate_navbar.html');?>
		<!--Navbar-->

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title ">SICK LEAVE HISTORY</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="leavehistorytable">
					<thead>
						<tr>
							<th>OP#</th>
							<th>RoomNo</th>
							<th>Date Applied</th>
							<th id = 'alignleft'>Reason</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Seen</th>						
						</tr>
					</thead>
					<tbody>
						<?php printresult($l_hist_details);; ?>						
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</body>

<!--Scripts for bootstrap working-->
	<?php include('_includes/links_script.html');?>
<!--Scripts for bootstrap working-->

<script>	
	$(document).ready(function() {
		$('#leavehistorytable').DataTable();
	} );	
</script>
