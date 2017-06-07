<?php
include('common_connection.php');
include('inmate_session.php');
include('_includes/php/functions.php');

$hist_fetch_sql_stmt = "select * from outpass_details where admno = '".$inmate_details['admno']."'  and warden_reject = 0 and return_confirm is null" ;
$hist_sql = $connection->query($hist_fetch_sql_stmt);
$hist_details = $hist_sql->fetch_all(MYSQLI_ASSOC);


function printresult($arraylist){
	foreach ($arraylist as $arrayob => $novalue) {
		$hiddenvar = $arraylist[$arrayob]['pass_no'] ; 
		echo "<tr>";
		echo "<td>".$arraylist[$arrayob]['pass_no']."</td>";
		echo "<td>".$arraylist[$arrayob]['issue_date']."</td>";
		echo "<td id = 'alignleft'>".$arraylist[$arrayob]['destination']."</td>";
		echo "<td id = 'alignleft'>".$arraylist[$arrayob]['purpose']."</td>";
		echo "<td>".$arraylist[$arrayob]['leaving_date']."</td>";
		echo "<td>".$arraylist[$arrayob]['leaving_time']."</td>";
		echo "<td>".$arraylist[$arrayob]['return_date']."</td>";
		echo "<td>".$arraylist[$arrayob]['return_time']."</td>";
		if ($arraylist[$arrayob]['warden_approval'])
		{
			echo '<td><button class="btn btn-success" style="display: -webkit-inline-box;"><span class="glyphicon glyphicon-eye-open"></span></button>
			<form action="common_actions_controller.php" method="post" style="display: -webkit-inline-box;" >
				<input type="hidden" name="pass_no" value= "'.$hiddenvar.'" >
				<button name="cancel_op" type="submit" title="Click here to cancel request" class="btn btn-info" value = 1 ><span class="glyphicon glyphicon-remove"></span></button>
				</form></td>';
		}
		else
		{
			echo '<td>
			<form action="common_actions_controller.php" method="post" >
				<input type="hidden" name="pass_no" value= "'.$hiddenvar.'" >
				<button name="cancel_op" type="submit" title="Click here to cancel request" class="btn btn-info" value = 1 >CANCEL REQUEST</button>
			</form>
		</td>';
	}
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

		

		<?php include('_includes/page_inmate_navbar_nav.html');?>

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title ">PENDING OUTPASS HISTORY</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="opstatustable">
					<thead>
						<tr>
							<th>OP#</th>
							<th>Issue Date</th>
							<th id = 'alignleft'>Destination</th>
							<th id = 'alignleft' >Purpose</th>
							<th>Leaving Date</th>
							<th>Leaving Time</th>
							<th>Return Date</th>
							<th>Return Time</th>
							<th>Warden Approval</th>
							
						</tr>
					</thead>
					<tbody>
						<?php printresult($hist_details);	?>						
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
		$('#opstatustable').DataTable();
	} );	
</script>



