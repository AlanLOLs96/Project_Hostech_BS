<?php
include('common_connection.php');
include('inmate_session.php');
include('_includes/php/functions.php');

$hist_fetch_sql_stmt = "select * from outpass_details where admno = '".$inmate_details['admno']."' and return_confirm is not null and warden_approval = 1 order by pass_no desc " ;
$hist_sql = $connection->query($hist_fetch_sql_stmt);
$hist_details = $hist_sql->fetch_all(MYSQLI_ASSOC);



foreach ($hist_details as $arrayob => $novalue) {
	unset($hist_details[$arrayob]['admno']);
	unset($hist_details[$arrayob]['warden_approval']);
	unset($hist_details[$arrayob]['warden_reject']);
//	unset($hist_details[$arrayob]['return_confirm']);
	
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

		<?php include('_includes/page_inmate_navbar_nav.html');?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title ">RETURN OUTPASS HISTORY</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="opreturntable">
					<thead>
						<tr>
							<th>OP#</th>
							<th>Issue Date</th>
							<th>Destination</th>
							<th >Purpose</th>
							<th>Leaving Date</th>
							<th>Leaving Time</th>
							<th>Return Date</th>
							<th>Return Time</th>
							<th>Actual Return Date</th>							
						</tr>
					</thead>
					<tbody>
						<?php listprinter($hist_details); ?>						
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
		$('#opreturntable').DataTable();
	} );	
</script>

