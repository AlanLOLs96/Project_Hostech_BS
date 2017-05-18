<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');


if($_SERVER['REQUEST_METHOD']=="POST")
{
	$trigger = 0;
	if(isset($_POST['remove_passout'])){
		$stmt = 'delete from inmate_details where semester = "S8" ';
		$sql = $connection->query($stmt);
	}
	if(isset($_POST['remove_sem'])){
		$stmt = 'delete from inmate_details where semester = "'.$_POST['sem_to_remove'].'" ';
		$sql = $connection->query($stmt);
	} 
	if(isset($_POST['inmate'])){
		$fetch_query = "select admno,fullname,semester,branch,roomno from inmate_details  where admno = '".$_POST['inmate']."' ";
		$search_sql = $connection->query($fetch_query);
		$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);

		if (mysqli_num_rows($search_sql)==0){
			$fetch_query = "select admno,fullname,semester,branch,roomno from inmate_details where fullname like '".$_POST['inmate']."%' ";
			$search_sql = $connection->query($fetch_query);
			$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);

			if (mysqli_num_rows($search_sql)==0)
				$trigger = 1;
		}
	}
	//if(isset($_POST['remove_inmate_confirm']))
	//	echo "working".$_POST['admno_to_remove'];

	function printresult($arraylist){
		foreach ($arraylist as $arrayob => $novalue) {
			$hiddenvar = $arraylist[$arrayob]['admno'];
			echo "<tr>";
			echo "<td>".$arraylist[$arrayob]['admno']."</td>";
			echo "<td id='alignleft'>".$arraylist[$arrayob]['fullname']."</td>";
			echo "<td>".$arraylist[$arrayob]['semester']."</td>";
			echo "<td>".$arraylist[$arrayob]['branch']."</td>";
			echo "<td>".$arraylist[$arrayob]['roomno']."</td>";
			echo '<td>
			<form action="common_actions_controller.php" method="post" >
				<input type="hidden" name="admno_to_remove" value= "'.$hiddenvar.'" >
				<input type="hidden" name="remove_inmate_confirm" value= "1" >
				<button class="btn btn-warning sbtn" ><span class="glyphicon glyphicon-ok"></span></button>
			</form>
			</td>';
		echo "</tr>";

	}
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

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Purge Records</h3>
			</div>
			<div class="panel-body">
				<ul class="list-group">
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-6">
								<h4>Purge Passout Records      </h4>
							</div>
							<div class="col-md-6">
								<form action="" method="post">
									<input type="hidden" name="remove_passout" value= "1" >
									<button class="btn btn-primary btn-block sbtn">PURGE</button>
								</form>								
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-6">
								<h4>Purge Semwise Records</h4>
							</div>
							<div class="col-md-6">
								<form action="" method="post">
									<select class="col-md-6 form-control" name = "sem_to_remove" style="width: 48%; margin: 0 1% 0 0 ;">
										<option selected disabled>SEM</option>
										<option value="1" >S1</option>
										<option value="2" >S2</option>
										<option value="3" >S3</option>
										<option value="4" >S4</option>
										<option value="5" >S5</option>
										<option value="6" >S6</option>
										<option value="7" >S7</option>
										<option value="8" >S8</option>
									</select>
									<input type="hidden" name="remove_sem" value= "1" >
									<button class="btn btn-warning col-md-6 sbtn">PURGE</button>
								</form>								
							</div>
						</div>
					</li>
					<li class="list-group-item">
						<div class="row">
							<div class="col-md-6">
								<h4>Purge Individual Records</h4>
							</div>
							<div class="col-md-6">
								<form action="" method="post">
									<div class="input-group">
										<form action="" method="POST">
											<input type="search" class="form-control" placeholder="Search for.." name="inmate">
											<span class="input-group-btn">
												<button class="btn btn-default" type="submit">Search</button>
											</span>
										</form>									
									</div>
								</form>								
							</div>
						</div>
					</li >
					<li class="list-group-item">
						<?php if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['inmate'])==1) {
							if($trigger)
								alertmessage(0,'Zero records found');
							else {
								echo '<table class="table table-striped">';
								echo '	<thead class="thead-inverse">';
								echo '		<tr>';
								echo '			<th>ADM#</th>';
								echo '			<th id="alignleft">Name</th>';
								echo '			<th>Sem</th>';
								echo '			<th>Branch</th>';
								echo '			<th>RoomNo</th>';
								echo '			<th>Remove</th>';
								echo '		</tr>';
								echo '	</thead>';
								echo '	<tbody> ';
								printresult($search_result);	
								echo '	</tbody>';
								echo '	</table> ';
							}							
						}
						?>
					</li>
				</ul>				
			</div>
		</div>
	</div>	
</body>

<!--Scripts for bootstrap working-->
<?php include('_includes/links_script.html');?>
<!--Scripts for bootstrap working-->

<script>	
	$(document).ready(function() {
		$('.sbtn').click(function(){			
			new PNotify(
			{
				title: 'Purging in Process',
				text: 'Item Sucessfully removed',
				styling: "bootstrap3",
				delay: 600,
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
   				 }, 1500); // in milliseconds
			});
		}
	} );	
</script>


