<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');

	//$search_admno = $_POST['search_bar'];
	//var_dump($_POST['search_bar']);

	//may have to add warden_approval
$fetch_query = "select * from complaint_details as cd,inmate_details as imd where fixing_date is null and cd.admno = imd.admno ";

$search_sql = $connection->query($fetch_query);
$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);
//echo var_dump($search_result);

function printresult($arraylist){
	foreach ($arraylist as $arrayob => $novalue) {
		$hiddenvar = $arraylist[$arrayob]['comp_no'];
		//	echo $hiddenvar;
		echo "<tr>";
		echo "<td>".$arraylist[$arrayob]['comp_no']."</td>";
		echo "<td>".$arraylist[$arrayob]['admno']."</td>";
		echo "<td id='alignleft'>".$arraylist[$arrayob]['fullname']."</td>";
		echo "<td>".$arraylist[$arrayob]['roomno']."</td>";
		echo "<td>".$arraylist[$arrayob]['complaint_type']."</td>";
		echo "<td id='alignleft'>".$arraylist[$arrayob]['description']."</td>";
		echo "<td>".$arraylist[$arrayob]['complaint_date']."</td>";
	//	echo "<td>".$arraylist[$arrayob]['fixing_date']."</td>";
		if (!($arraylist[$arrayob]['fixing_date']))
		{
			echo '<td>
			<form action="common_actions_controller.php" method="post" >
				<input type="hidden" name="compnum" value= "'.$hiddenvar.'" >
				<input type="hidden" name="complaintattend" value= 1 >
				<button class="btn btn-primary attendbutton">SET AS ATTENDED</button>
			</form>
		</td>';
	}
	else
		echo "<td align = 'center' ><span class='glyphicon glyphicon-remove'></span></td>";
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
		<?php include('_includes/page_assist_navbar.html');?>
		<!--Navbar-->

		<div class="panel panel-warning">
			<div class="panel-heading">
				<h3 class="panel-title">Confirm Complaints</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="complaint">
					<thead>
						<tr>
							<th>#</th>
							<th>Admission No</th>
							<th id='alignleft'>Name</th>
							<th>RoomNo</th>
							<th>Type</th>
							<th id='alignleft'>Description</th>
							<th>Posted Date</th>
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
    $('#complaint').DataTable();

    $('.attendbutton').click(function(){			
			new PNotify(
			{
				title:'Operation Done',
				text: 'Complaint set as Seen',
				styling: "bootstrap3",
				delay: 500,
				type: "warning"
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

