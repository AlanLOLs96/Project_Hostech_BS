<?php
include('common_connection.php');
include('admin_session.php');
include('_includes/php/functions.php');

$hist_fetch_sql_stmt = "select cd.comp_no,cd.admno,imd.fullname,cd.roomno,cd.complaint_type,cd.description,cd.complaint_date,cd.fixing_date from complaint_details as cd,inmate_details as imd where  fixing_date is not null and imd.admno=cd.admno " ;
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

		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title ">COMPLETE COMPLAINT HISTORY</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="complaint">
					<thead>
						<tr>
							<th>#</th>
							<th>Admission#</th>
							<th>Name</th>
							<th>RoomNo</th>
							<th>Type</th>
							<th>Description</th>
							<th>Issue Date</th>
							<th>Fixing Date</th>						
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
    $('#complaint').DataTable();
  } );  
</script>
