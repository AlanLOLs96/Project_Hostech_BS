<?php

include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');


if(isset($_POST["submit"]))
{
	if($_FILES['file']['name'])
	{
		$filename = explode(".", $_FILES['file']['name']);
		if($filename[1] == 'csv')
		{
			$handle = fopen($_FILES['file']['tmp_name'], "r");
			while($data = fgetcsv($handle))
			{
				$admno = mysqli_real_escape_string($connection, $data[0]);  
				$username = mysqli_real_escape_string($connection, $data[1]);
				$password = mysqli_real_escape_string($connection, $data[2]);
				$fullname = mysqli_real_escape_string($connection, $data[3]);
				$gender = mysqli_real_escape_string($connection, $data[4]);
				$semester = mysqli_real_escape_string($connection, $data[5]);
				$branch = mysqli_real_escape_string($connection, $data[6]);
				$roomno = mysqli_real_escape_string($connection, $data[7]);
				$phone_personal = mysqli_real_escape_string($connection, $data[8]);
				$phone_parent = mysqli_real_escape_string($connection, $data[9]);
				
				$stmt = "insert into inmate_details values($admno,'$username',PASSWORD('$password'),'$fullname','$gender',$semester,'$branch',$roomno)" ;
				//var_dump($stmt);
				$sql  = $connection->query($stmt);

				$stmt = "insert into inmate_contacts values($admno,$phone_personal,$phone_parent)";
			//	var_dump($stmt);
				$sql_ph = $connection->query($stmt);
			}
			fclose($handle);
			echo "<script>alert('Import done');</script>";
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
		<?php include('_includes/page_admin_navbar_nav.html');?>
		<!--Navbar-->

		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Insert From CSV</h3>
			</div>
			<div class="panel-body">
				<form method="post" enctype="multipart/form-data">
					<div class="alert alert-info" role="alert">Insert CSV Files Here</div>
					<div class="input-group">
						<label class="input-group-btn">
							<span class="btn btn-primary">
								Browse&hellip; <input type="file" name="file" style="display: none;" multiple>
							</span>
						</label>
						<input type="text" class="form-control" readonly>
					</div>						
					<input type="submit" name="submit" value="Import" class="btn btn-info btn-block" style="margin-top: 10px;" />
				</form>
				<div>
					<?php 
					if(isset($_POST["submit"]))
					{
						if($_FILES['file']['name'])
						{
							$filename = explode(".", $_FILES['file']['name']);
							if($filename[1] == 'csv')
							{
								$f = fopen($_FILES['file']['tmp_name'], "r");
								$fr = fread($f, filesize($_FILES['file']['tmp_name']));
								fclose($f);
								$lines = array();
								$lines = explode(";",$fr); // IMPORTANT the delimiter here just the "new line" \r\n, use what u need instead of... 
								echo '<table class="table table-striped" id="csvtable">';
								echo '<thead>';
								echo '<tr>';
								echo '<th>Admno</th>';						
								echo '<th>Username</th>';
								echo '<th>Password</th>';
								echo '<th>Full Name</th>';									
								echo '<th>Gender</th>';
								echo '<th>Sem</th>';
								echo '<th>Branch</th>';
								echo '<th>Roomno</th>';
								echo '<th>Phone.Personal</th>';
								echo '<th>Phone.Parent</th>';
								echo '</tr>';
								echo '</thead>';
								echo '<tbody>';
								for($i=0;$i<count($lines);$i++)
								{
									echo "<tr>";
									$cells = array(); 
								    $cells = explode(",",$lines[$i]); // use the cell/row delimiter what u need!
								    for($k=0;$k<count($cells);$k++)
								    {
								    	echo "<td>".$cells[$k]."</td>";
								    }
								    // for k end
								    echo "</tr>";
								}
								echo '</tbody>';
								echo '</table>';
							}
						}
					}						
					?>
				</div>
			</div>
		</div>
	</div>
</body>

<!--Scripts for bootstrap working-->
<?php include('_includes/links_script.html');?>
<!--Scripts for bootstrap working-->

<script>
	$(function() {
  // We can attach the `fileselect` event to all file inputs on the page
  $(document).on('change', ':file', function() {
  	var input = $(this),
  	numFiles = input.get(0).files ? input.get(0).files.length : 1,
  	label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  	input.trigger('fileselect', [numFiles, label]);
  });
  // We can watch for our custom `fileselect` event like this
  $(document).ready( function() {
  	$(':file').on('fileselect', function(event, numFiles, label) {
  		var input = $(this).parents('.input-group').find(':text'),
  		log = numFiles > 1 ? numFiles + ' files selected' : label;
  		if( input.length ) {
  			input.val(log);
  		} else {
  			if( log ) alert(log);
  		}
  	});
  });  
});
</script>

</html>