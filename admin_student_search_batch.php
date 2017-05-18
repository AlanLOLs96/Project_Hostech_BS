<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	//var_dump($_POST['param_sem']);
	//var_dump(isset($_POST['param_branch']));
	//var_dump($_POST['param_branch']);

	if($_POST['param_sem']!='NULL' && $_POST['param_branch'] == 'NULL')
	{
		$stmt = "select imd.admno,imd.fullname,imd.semester,imd.branch,imd.roomno,icd.inmate_phone,icd.parent_phone from inmate_details as imd,inmate_contacts as icd where  icd.admno = imd.admno and imd.semester = '".$_POST['param_sem']."' ";
	}
	else 
		if ($_POST['param_sem']=='NULL' && $_POST['param_branch'] != 'NULL')
		{
			$stmt = "select imd.admno,imd.fullname,imd.semester,imd.branch,imd.roomno,icd.inmate_phone,icd.parent_phone from inmate_details as imd,inmate_contacts as icd where  icd.admno = imd.admno and imd.branch = '".$_POST['param_branch']."' ";
		}
		else
			{
				$stmt = "select imd.admno,imd.fullname,imd.semester,imd.branch,imd.roomno,icd.inmate_phone,icd.parent_phone from inmate_details as imd,inmate_contacts as icd where  icd.admno = imd.admno and semester = '".$_POST['param_sem']."' and branch = '".$_POST['param_branch']."' "; 
			}

		$sql = $connection->query($stmt);
		$rslt = $sql->fetch_all(MYSQLI_ASSOC);
		//var_dump($rslt);

		function printresult($arraylist){
			foreach ($arraylist as $arrayob => $novalue) {
				echo "<tr>";
				echo "<td>".$arraylist[$arrayob]['admno']."</td>";
				echo "<td id = 'alignleft'>".$arraylist[$arrayob]['fullname']."</td>";
				echo "<td>".$arraylist[$arrayob]['semester']."</td>";
				echo "<td>".$arraylist[$arrayob]['branch']."</td>";
				echo "<td>".$arraylist[$arrayob]['roomno']."</td>";
				echo "<td>".$arraylist[$arrayob]['inmate_phone']."</td>";
				echo "<td>".$arraylist[$arrayob]['parent_phone']."</td>";

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
			<div class="panel panel-success">
				<div class="panel-heading">
					<h3 class="panel-title">Search Inmate</h3>
				</div>
				<div class="panel-body">
					<div class="well">
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<form action="" method="post">
									<div class="form-group">
										<label for="param_sem">SEM :</label>
										<select class="form-control" id="param" name="param_sem" style='
										display: inline-block;
										width: 30%;
										'>
										<option value="NULL"  selected>Select</option>
										<option value="1" >S1</option>
										<option value="2" >S2</option>
										<option value="3" >S3</option>
										<option value="4" >S4</option>
										<option value="5" >S5</option>
										<option value="6" >S6</option>
										<option value="7" >S7</option>
										<option value="8" >S8</option>
									</select>
									<label for="param_branch" style='
									margin-left: 10px;
									'>BRANCH :</label>
									<select class="form-control" id="param" name="param_branch" style='
									display: inline-block;
									width: 30%;
									'>
									<option value="NULL"  selected>Select</option>
									<option>CSE</option>
									<option>CHE</option>
									<option>ECE</option>
									<option>EEE</option>
								</select>
								<input class="btn btn-primary" type="submit" value="Search">
							</div>
						</form>							
					</div>
				</div>
			</div>
			<table class="table table-striped" id="resulttable">
				<thead>
					<tr>
						<th>Adm No.</th>
						<th id = 'alignleft'>Full Name</th>
						<th>Sem</th>
						<th>Branch</th>							
						<th>Room No</th>	
						<th>Inmate.Ph</th>
						<th>Parent.Ph</th>				
					</tr>
				</thead>
				<tbody>
					<?php if($_SERVER['REQUEST_METHOD']=='POST') printresult($rslt); ?>				
				</tbody>
			</table>
		</div>


	</div>


</div>

</div>

</body>

<!--Scripts for bootstrap working-->
<?php include('_includes/links_script.html');?>
<!--Scripts for bootstrap working-->

<script>	
	$(document).ready(function() {
		$('#resulttable').DataTable();
	} );	
</script>
