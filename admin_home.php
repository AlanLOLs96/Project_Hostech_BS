<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');


$fetch_query = "select * from outpass_details as opd,inmate_details as imd  where warden_approval = 0 and warden_reject = 0 and opd.admno = imd.admno";
$search_sql = $connection->query($fetch_query);
$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);
//var_dump($search_result);

function printresult($arraylist){
	foreach ($arraylist as $arrayob => $novalue) {
		$pass_no = $arraylist[$arrayob]['pass_no'];
		$adm_no = $arraylist[$arrayob]['admno'];
		echo "<tr>";
		echo "<td>".$arraylist[$arrayob]['pass_no']."</td>";
		echo "<td id='alignleft'>".$arraylist[$arrayob]['fullname']."</td>";
		echo "<td>".$arraylist[$arrayob]['semester']."</td>";
		echo "<td>".$arraylist[$arrayob]['roomno']."</td>";
		echo "<td  id='alignleft' >".$arraylist[$arrayob]['destination']."</td>";
		echo "<td  id='alignleft'>".$arraylist[$arrayob]['purpose']."</td>";
		echo "<td>".$arraylist[$arrayob]['leaving_date']."</td>";
		echo "<td>".$arraylist[$arrayob]['leaving_time']."</td>";
		echo "<td>".$arraylist[$arrayob]['return_date']."</td>";
		echo "<td>".$arraylist[$arrayob]['return_time']."</td>";
		echo '<td style="padding: 8px 2px;">
		<form  action="common_actions_controller.php" method="post" style="display: -webkit-inline-box;">
		<input type="hidden" name="pass_no" value= "'.$pass_no.'" >
		<input type="hidden" name="adm_no" value= "'.$adm_no.'" >
		<input type="hidden" name="approve" value= 1>
		<button class="btn btn-success approvebutton"><span class="glyphicon glyphicon-ok"></span></button>
		</form>
		<form   action="common_actions_controller.php" method="post"style="display: -webkit-inline-box;">
		<input type="hidden" name="pass_no" value= "'.$pass_no.'" >
		<input type="hidden" name="adm_no" value= "'.$adm_no.'" >
		<input type="hidden" name="reject" value= 1>
		<button class="btn btn-danger rejectbutton" ><span class="glyphicon glyphicon-remove"></span></button>
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
				<h3 class="panel-title">REVIEW PASSES</h3>
			</div>
			<div class="panel-body">
				<table id="testtable" class="table table-striped">
					<thead>
						<tr>
							<th>OP#</th>
							<th id='alignleft'>Name</th>
							<th>Sem</th>
							<th>Room#</th>
							<th  id='alignleft'>Destination</th>
							<th  id='alignleft'>Purpose</th>
							<th>Leaving Date</th>
							<th>Leaving Time</th>
							<th>Return Date</th>
							<th>Return Time</th>	
							<th>Approve</th>
						</tr>
					</thead>
					<tbody>
						<?php printresult($search_result); ?>						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
<!--Scripts or bootstrap working-->
<?php include('_includes/links_script.html');?>
<script>	
	$(document).ready(function() {
		$('#testtable').DataTable();

		$('.approvebutton').click(function(){		
			new PNotify(
			{
				title: 'Operation Done',
				text: 'Outpass Successfully approved !',
				styling: "bootstrap3",
				delay: 500,
				type: "success"
			});
			submitForm();
		});	

		$('.rejectbutton').click(function(){			
			new PNotify(
			{
				title: 'Operation Done',
				text: 'Outpass Successfully Rejected',
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





