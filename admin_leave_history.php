<?php
include('common_connection.php');
include('admin_session.php');
include('_includes/php/functions.php');

$l_hist_fetch_sql_stmt = "select sld.leave_no,sld.admno,imd.fullname,sld.roomno,sld.date_applied,sld.reason,sld.start_time,sld.end_time,sld.seen from sick_leave_details as sld , inmate_details as imd where seen is not null and sld.admno=imd.admno" ;
$l_hist_sql = $connection->query($l_hist_fetch_sql_stmt);
$l_hist_details = $l_hist_sql->fetch_all(MYSQLI_ASSOC);

foreach ($l_hist_details as $arrayob => $novalue) 
	unset($l_hist_details[$arrayob]['seen']);

?>

<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>

<body>
	<div class="container">
		<!--Navbar-->
		<?php include('_includes/page_admin_navbar.html');?>
		<!--Navbar-->

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title ">COMPLETE LEAVE HISTORY</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="leave">
					<thead>
						<tr>
							<th>Leave#</th>
							<th>AdmNo</th>
							<th>Name</th>
							<th>RoomNo</th>							
							<th>Date Applied</th>
							<th>Reason</th>
							<th>Start Time</th>						
							<th>End Time</th>
						</tr>
					</thead>
					<tbody>
						<?php listprinter($l_hist_details); ?>						
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
		$('#leave').DataTable();
	} );	
</script>

