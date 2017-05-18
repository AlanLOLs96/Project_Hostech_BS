<?php
include('common_connection.php');
include('admin_session.php');
include('_includes/php/functions.php');

$hist_fetch_sql_stmt = "select * from outpass_details where  return_confirm is null and warden_approval = 1 " ;
$hist_sql = $connection->query($hist_fetch_sql_stmt);
$hist_details = $hist_sql->fetch_all(MYSQLI_ASSOC);



foreach ($hist_details as $arrayob => $novalue) {
	//unset($hist_details[$arrayob]['admno']);
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
		<?php include('_includes/page_assist_navbar.html');?>
		<!--Navbar-->

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title ">COMPLETE RETURN OUTPASS HISTORY</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>OP#</th>
							<th>Admission Number</th>
							<th>Issue Date</th>
							<th>Destination</th>
							<th>Purpose</th>
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
	<!--Scripts for bootstrap working-->
	<?php include('_includes/links_script.html');?>
	<!--Scripts for bootstrap working-->
</body>


