<?php
include_once('common_connection.php');
include_once('admin_session.php');
include_once('_includes/php/functions.php');
include('way2sms-api.php');

if($_SERVER['REQUEST_METHOD']=="POST")
{
	if(isset($_POST['approve']))
	{
		$up_stmt = "update outpass_details set warden_approval = 1 where pass_no = '".$_POST["pass_no"]."' " ;
		$up_stmt_sql = $connection->query($up_stmt);

		$msgstring = generateConfirmSMS($_POST["pass_no"],$_POST["adm_no"],$connection);
		$phonenumbers = getNumbers($_POST["adm_no"],$connection);
		
		//echo $msgstring;
		//echo $phonenumbers;

		//sendWay2SMS ( '9544867362' , '9544867362' , $phonenumbers , $msgstring);		
		unset($_POST['approve']);
		header("location:admin_home.php");
	}
	if (isset($_POST['reject'])) {
		$up_stmt = "update outpass_details set warden_reject = 1 where pass_no = '".$_POST["pass_no"]."' " ;
		$up_stmt_sql = $connection->query($up_stmt);

		$msgstring = generateRejectSMS($_POST["pass_no"],$_POST["adm_no"],$connection);
		$phonenumbers = getNumbers($_POST["adm_no"],$connection);

		//echo $msgstring;
		//echo $phonenumbers;

		//sendWay2SMS ( '9544867362' , '9544867362' , $phonenumbers , $msgstring);		

		unset($_POST['reject']);
		header("location:admin_home.php");


	}
	if (isset($_POST['sendwarning'])) {

		$msgstring = generateWarningSMS($_POST["pass_no"],$_POST["adm_no"],$connection);
		$phonenumbers = getNumbers($_POST["adm_no"],$connection);

		//sendWay2SMS ( '9656331482' , 'alanlal123' , $phonenumbers , $msgstring);		

		unset($_POST['sendwarning']);
		header("location:admin_op_return.php");

	}
	if(isset($_POST['cancel_op']))
	{
		var_dump( $_POST['pass_no']);

		$stmt = "delete from outpass_details where pass_no  = '".$_POST["pass_no"]."' ";
		$stmt_sql = $connection->query($stmt);

		
		unset($_POST['cancel_op']);
		header("location:inmate_op_history_status.php");
	}
	if(isset($_POST['complaintattend']))
	{
		$up_stmt = "update complaint_details set fixing_date = '".date("Y-m-d")."' where comp_no = '".$_POST["compnum"]."' " ;
		$up_stmt_sql = $connection->query($up_stmt);

		//echo var_dump($up_stmt_sql);

		unset($_POST['complaintattend']);
		header("location:assist_complaints.php");
	}
	if(isset($_POST['opreturnconfirm']))
	{
		$up_stmt = "update outpass_details set return_confirm = '".date("Y-m-d")."' where pass_no = '".$_POST["opnum"]."' " ;
		$up_stmt_sql = $connection->query($up_stmt);

		unset($_POST['opreturnconfirm']);
		header("location:assist_home.php");
	}
	if(isset($_POST['leaveconfirm']))
	{
		$up_stmt = "update sick_leave_details set seen = 1 where leave_no = '".$_POST["leavenum"]."' " ;
		$up_stmt_sql = $connection->query($up_stmt);

		//echo var_dump($up_stmt_sql);
		
		unset($_POST['leaveconfirm']);
		header("location:admin_leave.php");

	}
	if(isset($_POST['remove_inmate_confirm']))
	{
		echo "working".$_POST['admno_to_remove'];

		$stmt = "delete from inmate_details where admno = '".$_POST['admno_to_remove']."' ";
		$sql = $connection->query($stmt);

		unset($_POST['remove_inmate_confirm']);
		header("location:admin_details_edit.php");
	}	

	

}