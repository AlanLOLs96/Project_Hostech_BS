<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$search_admno = $_POST['search_bar'];
	//var_dump($_POST['search_bar']);

	//may have to add warden_approval
	$fetch_query = "select *  from outpass_details as opd , inmate_details as imd where opd.admno = '$search_admno' and warden_approval = 1 and warden_reject = 0 and return_confirm is null and opd.admno = imd.admno";

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
			echo "<td>".$arraylist[$arrayob]['issue_date']."</td>";
			echo "<td id='alignleft'>".$arraylist[$arrayob]['destination']."</td>";
			echo "<td id='alignleft'>".$arraylist[$arrayob]['purpose']."</td>";
			echo "<td>".$arraylist[$arrayob]['leaving_date']."</td>";
			echo "<td>".$arraylist[$arrayob]['leaving_time']."</td>";
			echo "<td>".$arraylist[$arrayob]['return_date']."</td>";
			echo "<td>".$arraylist[$arrayob]['return_time']."</td>";
			if (!($arraylist[$arrayob]['return_confirm']))
			{
				if ($arraylist[$arrayob]['leaving_date']!=date('Y-m-d'))
				{
					echo "hello";
					echo   '<script>
					          $(document).ready(function(){
					                 $(".confirmer").prop("disabled", true);
					               });     
					         </script>';
				}
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
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>
<?php include_once('_includes/links_script.html');?>

<body>
	<div class="container">
		<!--Navbar-->
		<?php include('_includes/page_assist_navbar.html');?>
		<!--Navbar-->
		<?php include('_includes/page_assist_navbar_nav.html');?>

		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title">Search Outpass</h3>
			</div>
			<div class="panel-body">
				<form action="assist_home.php" method="post">
					<div class="col-md-6 col-md-offset-3">					
						<div class="input-group">
							<input name="search_bar" type="text" class="form-control" placeholder="Enter Admission Number...">
							<span class="input-group-btn">
								<input class="btn btn-primary" type="submit" value="Search">
							</span>
						</div>
					</div>
				</form>	
				<div class="page-header">
					<h3><small>SEARCH RESULTS</small></h3>
				</div>	

				<!--Alert Function-->
				<?php if($_SERVER['REQUEST_METHOD']=='POST') {
					if(mysqli_num_rows($search_sql)==0)
						alertmessage(1,'Zero records found');
				}  
				?>
				<!--Alert Function-->

				<table class="table table-striped">
					<thead class="thead-inverse">
						<tr>
							<th>OP#</th>
							<th>ADM#</th>
							<th id='alignleft'>Name</th>
							<th>Issue Date</th>
							<th id='alignleft'>Destination</th>
							<th id='alignleft'>Purpose</th>
							<th>Leaving Date</th>
							<th>Leaving Time</th>
							<th>Return Date</th>
							<th>Return Time</th>
							<th>Approve Return</th>							
						</tr>
					</thead>
					<tbody>
						<?php  if($_SERVER['REQUEST_METHOD']=='POST')
						{printresult($search_result);} ?>						
					</tbody>
				</table>
			</div>
		</div>
		<!--Scripts for bootstrap working-->
		<?php include_once('_includes/links_script.html');?>
		<!--Scripts for bootstrap working-->
	</body>


