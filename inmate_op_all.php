<?php 
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');


$fetch_query = "select *  from outpass_details as opd , inmate_details as imd where warden_approval = 1 and warden_reject = 0 and return_confirm is null and opd.admno = imd.admno";

	$search_sql = $connection->query($fetch_query);
	$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);
	//var_dump($search_result);

	function printresult($arraylist){
		foreach ($arraylist as $arrayob => $novalue) {
			$hiddenvar = $arraylist[$arrayob]['pass_no'];
		//	echo $hiddenvar;
			echo "<tr>";
			echo "<td>".$arraylist[$arrayob]['pass_no']."</td>";
			echo "<td>".$arraylist[$arrayob]['admno']."</td>";
			echo "<td id='alignleft'>".$arraylist[$arrayob]['fullname']."</td>";
		//	echo "<td>".$arraylist[$arrayob]['issue_date']."</td>";
			echo "<td id='alignleft'>".$arraylist[$arrayob]['destination']."</td>";
			echo "<td id='alignleft'>".$arraylist[$arrayob]['purpose']."</td>";
			echo "<td>".$arraylist[$arrayob]['leaving_date']."</td>";
		//	echo "<td>".$arraylist[$arrayob]['leaving_time']."</td>";
			echo "<td>".$arraylist[$arrayob]['return_date']."</td>";
			echo "<td>".$arraylist[$arrayob]['return_time']."</td>";
			if (!($arraylist[$arrayob]['return_confirm']))
			{
				if ($arraylist[$arrayob]['leaving_date']>date('Y-m-d'))
				{
					echo '<td><button name="opreturnconfirm" type="submit" class="btn btn-primary confirmer" title = "Inmate has not left yet" value = 1 disabled>CONFIRM RETURN</button></td>';
				}
				else
				echo '<td>
				<form action="common_actions_controller.php" method="post" >
					<input type="hidden" name="opnum" value= "'.$hiddenvar.'" >
					<button name="opreturnconfirm" type="submit" class="btn btn-primary confirmer" value = 1 >CONFIRM RETURN</button>
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
<?php include('_includes/links_script.html');?>

<body>
	<div class="container">
		<!--Navbar-->
		<?php include('_includes/page_assist_navbar.html');?>
		<?php include('_includes/page_assist_navbar_nav.html');?>
		<!--Navbar-->

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Inmates Yet to Return</h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped" id="opall">
					<thead class="thead-inverse">
						<tr>
							<th>OP#</th>
							<th>ADM#</th>
							<th id='alignleft'>Name</th>
							<th id='alignleft'>Destination</th>
							<th id='alignleft'>Purpose</th>
							<th>Leaving Date</th>
							<th>Return Date</th>
							<th>Return Time</th>
							<th>Approve Return</th>							
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

<!--Scripts for bootstrap working-->
<?php include_once('_includes/links_script.html');?>
<!--Scripts for bootstrap working-->

<script>	
	$(document).ready(function() {
		$('#opall').DataTable();
	} );	
</script>
