<?php
include('common_connection.php');
include('admin_session.php');
include('_includes/php/functions.php');

$hist_fetch_sql_stmt = "select * from outpass_details as opd , inmate_details as imd where return_confirm is null and warden_approval = 1 and opd.admno=imd.admno " ;
$hist_sql = $connection->query($hist_fetch_sql_stmt);
$hist_details = $hist_sql->fetch_all(MYSQLI_ASSOC);

foreach ($hist_details as $arrayob => $novalue) 
	{
		unset($hist_details[$arrayob]['username']);
		unset($hist_details[$arrayob]['password']);
		unset($hist_details[$arrayob]['gender']);
	}


function printresult($arraylist){
	foreach ($arraylist as $arrayob => $novalue) {
		$pass_no = $arraylist[$arrayob]['pass_no'];
		$adm_no = $arraylist[$arrayob]['admno'];
		echo "<tr>";
		echo "<td>".$arraylist[$arrayob]['pass_no']."</td>";
		echo "<td>".$arraylist[$arrayob]['admno']."</td>";
		echo "<td id='alignleft'>".$arraylist[$arrayob]['fullname']."</td>";
		echo "<td>".$arraylist[$arrayob]['semester']."</td>";
		echo "<td>".$arraylist[$arrayob]['roomno']."</td>";
		echo "<td  id='alignleft' >".$arraylist[$arrayob]['destination']."</td>";
		echo "<td  id='alignleft'>".$arraylist[$arrayob]['purpose']."</td>";
		echo "<td>".$arraylist[$arrayob]['leaving_date']."</td>";
		echo "<td>".$arraylist[$arrayob]['return_date']."</td>";
		echo "<td>".$arraylist[$arrayob]['return_time']."</td>";
		echo '<td style="padding: 8px 2px;">
		<form  action="common_actions_controller.php" method="post" style="display: -webkit-inline-box;">
		<input type="hidden" name="pass_no" value= "'.$pass_no.'" >
		<input type="hidden" name="adm_no" value= "'.$adm_no.'" >
		<input type="hidden" name="sendwarning" value= 1>
		<button class="btn btn-success warningbutton"><span class="glyphicon glyphicon-ok"></span> SEND WARNING</button>
		</form>
		</td>';
}
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>

<body>
	<div class="container">
		<!--Navbar-->
		<?php include('_includes/page_admin_navbar.html');?>
		<!--Navbar-->

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title ">INMATES YET TO RETURN</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="optable">
					<thead>
						<tr>
							<th>OP#</th>
							<th>Adm#</th>
							<th id="alignleft">Name</th>
							<th>Sem</th>
							<th>RoomNo</th>
							<th id="alignleft">Destination</th>
							<th id="alignleft">Purpose</th>
							<th>Leaving Date</th>
							<th>Return Date</th>
							<th>Return Time</th>
							<th>Send Warning</th>						
						</tr>
					</thead>
					<tbody>
						<?php printresult($hist_details); ?>						
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
		$('#optable').DataTable();

		$('.warningbutton').click(function(){			
			new PNotify(
			{
				title: 'Operation Done',
				text: 'A Warning message has been sent to the person',
				styling: "bootstrap3",
				delay: 500,
				type: "info"
			});
			submitForm();			
		});	

		function submitForm(){
			$('form').submit(function (e) {
				var form = this;
				e.preventDefault();
				setTimeout(function () {
					form.submit();
   				 }, 1500); // in milliseconds
			});
		}
	} );	
</script>

