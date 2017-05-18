<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$search_admno = $_POST['search_bar'];
	$trigger = 0;
	//var_dump($_POST['search_bar']);

	//may have to add warden_approval
	$fetch_query = "select * from inmate_details ,inmate_contacts where inmate_details.admno = '".$search_admno."' and inmate_details.admno = inmate_contacts.admno ";
	$search_sql = $connection->query($fetch_query);
	$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);

	if (mysqli_num_rows($search_sql)==0){
		$fetch_query = "select * from inmate_details ,inmate_contacts where inmate_details.fullname like '".$search_admno."%' and inmate_details.admno = inmate_contacts.admno ";
			$search_sql = $connection->query($fetch_query);
			$search_result =  $search_sql->fetch_all(MYSQLI_ASSOC);

			if (mysqli_num_rows($search_sql)==0)
				$trigger = 1;
	}


	//var_dump($search_result);

	foreach ($search_result as $arrayob => $novalue)
		unset($search_result[$arrayob]['password']);

	function printer($arraylist){
		foreach ($arraylist as $arrayob => $novalue){
			echo "<div class='well list-group'>" ;
			echo "<h4 class='list-group-item-heading '>".$arraylist[$arrayob]['fullname']."</h4>" ;
			echo "<ul class='list-group'>" ;
			echo "	<li class='list-group-item'>Admission Number : ".$arraylist[$arrayob]['admno']."</li>" ;
			echo "	<li class='list-group-item'>Semester         : ".$arraylist[$arrayob]['semester']."</li>" ;
			echo "	<li class='list-group-item'>Branch			 : ".$arraylist[$arrayob]['branch']."</li>" ;
			echo "	<li class='list-group-item'>Room no      	 : ".$arraylist[$arrayob]['roomno']."</li>" ;
			echo "	<li class='list-group-item'>Personal No 	 : ".$arraylist[$arrayob]['inmate_phone']."</li>" ;
			echo "	<li class='list-group-item'>Parent No   	 : ".$arraylist[$arrayob]['parent_phone']."</li>" ;
			echo "</ul>" ;
			echo "</div>" ;
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

		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Search Inmate</h3>
			</div>
			<div class="panel-body">
				<form action="" method="post">
					<div class="col-md-6 col-md-offset-3">					
						<div class="input-group">
							<input name="search_bar" type="search" class="form-control" placeholder="Enter Admission Number or student name..." required>
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
					if($trigger)
						alertmessage(1,'Zero records found');
					//else
						//var_dump($search_result);

				}  
				?>
				<!--Alert Function-->
				
				<?php if($_SERVER['REQUEST_METHOD']=='POST') {
					 printer($search_result);
				}  
				?>

			</div>


		</div>
		<!--Scripts for bootstrap working-->
		<?php include('_includes/links_script.html');?>
		<!--Scripts for bootstrap working-->
	</body>


