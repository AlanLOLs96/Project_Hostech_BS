<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');

	//$search_admno = $_POST['search_bar'];
	//var_dump($_POST['search_bar']);

	//may have to add warden_approval
$fetch_query = "select * from sick_leave_details as sld , inmate_details as imd where seen is null and sld.admno=imd.admno";

$search_sql = $connection->query($fetch_query);
$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);
//echo var_dump($search_result);

function printresult($arraylist){
	foreach ($arraylist as $arrayob => $novalue) {
		$hiddenvar = $arraylist[$arrayob]['leave_no'];
		//	echo $hiddenvar;
		echo "<tr>";
		echo "<td>".$arraylist[$arrayob]['leave_no']."</td>";
		echo "<td>".$arraylist[$arrayob]['admno']."</td>";
		echo "<td id='alignleft'>".$arraylist[$arrayob]['fullname']."</td>";
		echo "<td>".$arraylist[$arrayob]['roomno']."</td>";
		echo "<td>".$arraylist[$arrayob]['date_applied']."</td>";
		echo "<td id='alignleft'>".$arraylist[$arrayob]['reason']."</td>";
		echo "<td>".$arraylist[$arrayob]['start_time']."</td>";
		echo "<td>".$arraylist[$arrayob]['end_time']."</td>";
		echo '<td>
				<form action="common_actions_controller.php" method="post" >
					<input type="hidden" name="leavenum" value= "'.$hiddenvar.'" >
					<input type="hidden" name="leaveconfirm" value= 1>
					<button class="btn btn-primary approvebutton">SET AS SEEN</button>
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

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Confirm Leaves</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="leave">
					<thead>
						<tr>
							<th>Leave#</th>
							<th>Admission #</th>
							<th id='alignleft'>Name</th>
							<th>RoomNo</th>
							<th>Date Applied</th>
							<th id='alignleft'>Reason</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Status</th>						
						</tr>
					</thead>
					<tbody>
						<?php printresult($search_result); ?>						
					</tbody>
				</table>
			</div>
		</div>
</body>

<!--Scripts for bootstrap working-->
		<?php include('_includes/links_script.html');?>
<!--Scripts for bootstrap working-->
<script>	
	$(document).ready(function() {
		$('#leave').DataTable();

		$('.approvebutton').click(function(){			
			new PNotify(
			{
				title: 'Operation Done',
				text: 'Leave Successfully Marked',
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
   				 }, 1000); // in milliseconds
			});
		}
	} );	
</script>
