<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');

?>
<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>

<body>
	<div class="container">
		<!--Navbar-->
		<?php include('_includes/page_assist_navbar.html');?>
		<!--Navbar-->
		
		<div class="jumbotron">
			<h1>Food Count</h1>
			<h2><?=calcFoodCount($connection);?>/3000</h2>
		</div>

	</div>
	<!--Scripts for bootstrap working-->
	<?php include('_includes/links_script.html');?>
	<!--Scripts for bootstrap working-->
</body>


