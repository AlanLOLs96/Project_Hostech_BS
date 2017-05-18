<?php

include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');


if($_SERVER['REQUEST_METHOD']=='POST')
{
	$trigger = 0;
	$admno   	=  $_POST['admno'];
	$fullname	=  $_POST['fullname'];
	$username	=  $_POST['username'];
	$password 	=  $_POST['password'];
	$gender		=  $_POST['gender'];
	$semester	=  $_POST['semester'];
	$branch		=  $_POST['branch'];
	$phone_personal	=  $_POST['phone_personal'];
	$phone_parent	=  $_POST['phone_parent'];
	$roomno	=  $_POST['roomno'];

	$stmt = "insert into inmate_details values($admno,'$username',PASSWORD('$password'),'$fullname','$gender',$semester,'$branch',$roomno)" ;
	$sql  = $connection->query($stmt);

	$stmt = "insert into inmate_contacts values($admno,$phone_personal,$phone_parent)";
	$sql_ph = $connection->query($stmt);
	//var_dump($sql);
	if ($sql) $trigger  = 1;
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>

<body>
	<div class="container">
		<!--Navbar-->
		<?php include('_includes/page_admin_navbar.html');?>
		<?php include('_includes/page_admin_navbar_nav.html');?>
		<!--Navbar-->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Insert New Record</h3>
			</div>
			<div class="panel-body">

				<!--Alert Function-->
				<?php if($_SERVER['REQUEST_METHOD']=='POST') {
					if($trigger==1)
						alertmessage($trigger,'Insertion Successful');
					else
						alertmessage(0,'Insertion Failed , Admission Number alreay exists !');
				}
				?>
				<!--Alert Function-->

				<form class="well form-horizontal"  action="" method="post" >
					<fieldset>
						<div class="form-group">
							<label class="col-md-4 control-label">Admission No</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
									<input  name="admno" placeholder="Admission No" class="form-control"  type="text">
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Full Name</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="fullname" placeholder="Full Name" class="form-control"  type="text"  required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">User Name</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
									<input  name="username" placeholder="Username is firstname+admno" class="form-control"  type="text"  required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" >Password</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-asterisk"></i></span>
									<input name="password" class="form-control"  type="password"  required>
								</div>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label">Gender</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<label class="radio-inline"><input type="radio" value="M" name="gender">Male</label>
									<label class="radio-inline"><input type="radio" value="F" name="gender">Female</label>
								</div>
							</div>
						</div>

						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-4 control-label">Semester</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
									<select class="form-control" name="semester" required>
										<option disabled selected>Select Sem</option>
										<option value="1">S1</option>
										<option value="2">S2</option>
										<option value="3">S3</option>
										<option value="4">S4</option>
										<option value="5">S5</option>
										<option value="6">S6</option>
										<option value="7">S7</option>
										<option value="8">S8</option>
									</select>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label" >Branch</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
									<select class="form-control" name="branch">
										<option disabled selected>Select Branch</option>
										<option value="CHE">CHE</option>
										<option value="CSE">CSE</option>
										<option value="EEE">EEE</option>
										<option value="ECE">ECE</option>
									</select>
								</div>
							</div>
						</div>		

						<div class="form-group">
							<label class="col-md-4 control-label">RoomNO</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
									<input name="roomno" placeholder="Enter RoomNo" class="form-control" type="number" min="100" max="999"  required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Personal</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input name="phone_personal" placeholder="Personal Phone number" class="form-control" type="tel" max="9999999999" required>
								</div>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Phone Parent</label>
							<div class="col-md-4 inputGroupContainer">
								<div class="input-group">
									<span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>
									<input name="phone_parent" placeholder="Parent's Phone number" class="form-control" type="tel" max="9999999999" required>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 inputGroupContainer">
								<div class="form-group text-right buttonright">
									<input class="btn btn-primary" type="submit" value="Submit">
								</div>
							</div>
							<div class="col-md-6 inputGroupContainer">
								<div class="form-group text-left buttonleft">
									<input class="btn btn-primary" type="reset" value="Reset">
								</div>
							</div>
						</div>
					</fieldset>
				</form>
				<?php 
				if($_SERVER['REQUEST_METHOD']=='POST' && $trigger == 1)
				{	
					$stmt = "select inmate_details.admno,fullname,username,semester,gender,roomno,inmate_contacts.inmate_phone,inmate_contacts.parent_phone from inmate_details,inmate_contacts where inmate_details.admno = '".$admno."' and inmate_details.admno = inmate_contacts.admno";
					$sql = $connection->query($stmt);
					$result = $sql->fetch_all(MYSQLI_ASSOC);	
					//var_dump($result);


					echo '<table class="table table-striped">';
						echo '<thead>';
							echo '<tr>';
							echo '<th>Admno</th>';
							echo '<th>Full Name</th>';
							echo '<th>Username</th>';
							echo '<th>Sem</th>';
							echo '<th>Gender</th>';
							echo '<th>RoomNO</th>';
							echo '<th>Phone.Personal</th>';
							echo '<th>Phone.Parent</th>';
							echo '</tr>';
						echo '</thead>';
						echo '<tbody>';
								listprinter($result);
						echo '</tbody>';
					echo '</table>';
					}
					?>
				</div>
			</div>


		</div>

	</body>

	<!--Scripts for bootstrap working-->
	<?php include('_includes/links_script.html');?>
	<!--Scripts for bootstrap working-->
