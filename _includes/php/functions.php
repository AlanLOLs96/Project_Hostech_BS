<?php

function alertmessage($trigval,$msgstring)
{
	if($trigval)
	{
		echo '<div class="panel-body">' ;
		echo '<div class="alert alert-success alert-dismissible" role="alert">' ;
		echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		echo $msgstring ;
		echo '</div>' ;

	}
	else
	{
		echo '<div class="panel-body">' ;
		echo '<div class="alert alert-danger alert-dismissible" role="alert">' ;
		echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
		echo $msgstring ;
		echo '</div>' ;
	}
}

function listprinter($arraylist){
	foreach ($arraylist as $eachrow => $rowvalue) {
		echo "<tr>";
		foreach ($rowvalue as  $value) {
			echo "<td>".$value."</td>";
		}
		echo "</tr>";
	}		
}

function generateConfirmSMS($passno,$admno,$connection)
{
	$up_stmt = "select od.pass_no , od.destination, od.purpose, od.leaving_date, od.return_date, id.fullname from outpass_details as od , inmate_details as id where id.admno = '".$admno."' and od.admno = '".$admno."' and od.pass_no = '".$passno."' ";
	$up_stmt_sql = $connection->query($up_stmt);
	$search_result =  mysqli_fetch_assoc($up_stmt_sql);

	$msg =  "[PASS ISSUED !] OP# ".$search_result['pass_no']." Name:-".$search_result['fullname']." D:-".$search_result['destination']."  P:-".$search_result['purpose']." DL:-".$search_result['leaving_date']." DR:-".$search_result['return_date'];

	return $msg;
}
function generateRejectSMS($passno,$admno,$connection)
{
	$up_stmt = "select od.pass_no , od.destination, od.purpose, od.leaving_date, od.return_date, id.fullname from outpass_details as od , inmate_details as id where id.admno = '".$admno."' and od.admno = '".$admno."' and od.pass_no = '".$passno."' ";
	$up_stmt_sql = $connection->query($up_stmt);
	$search_result =  mysqli_fetch_assoc($up_stmt_sql);

	$msg =  "[PASS REJECTED !] OP# ".$search_result['pass_no']." Name:-".$search_result['fullname']." D:-".$search_result['destination']."  P:-".$search_result['purpose']." DL:-".$search_result['leaving_date']." DR:-".$search_result['return_date'];

	return $msg;
}

function generateWarningSMS($passno,$admno,$connection)
{
	$up_stmt = "select od.pass_no , od.destination, od.purpose, od.leaving_date, od.return_date, id.fullname from outpass_details as od , inmate_details as id where id.admno = '".$admno."' and od.admno = '".$admno."' and od.pass_no = '".$passno."' ";
	$up_stmt_sql = $connection->query($up_stmt);
	$search_result =  mysqli_fetch_assoc($up_stmt_sql);

	$msg =  "[Inmate Has not yet returned !] Name:-".$search_result['fullname']." Dest:-".$search_result['destination']."  Purpose:-".$search_result['purpose']." DR:-".$search_result['return_date'];

	return $msg;
}

function getNumbers($admno,$connection){
	$stmt = "select * from inmate_contacts where admno = '".$admno."'";
	$stmt_sql = $connection->query($stmt);
	$result = mysqli_fetch_assoc($stmt_sql);
	//var_dump($result);
	$number = $result['inmate_phone'].",".$result['parent_phone'];
	return $number;
}

function calcFoodCount($connection)
{
	$date = date('Y-m-d');

	$stmt = "select count(*) from outpass_details where  warden_approval = 1 and leaving_date = '".$date."' and return_confirm = '".$date."' ";
	$stmt_sql = $connection->query($stmt);
	$neutral = mysqli_fetch_row($stmt_sql);

	//var_dump("neutral ".(int)$neutral[0]);
//changer
	$stmt = "select count(*) from outpass_details where  warden_approval = 1 and leaving_date <= '".$date."' and return_confirm = '".$date."' ";
	$stmt_sql = $connection->query($stmt);
	$coming = mysqli_fetch_row($stmt_sql);

	//var_dump("comging ".(int)$coming[0]);
//changer


	$stmt = "select count(*) from outpass_details where warden_approval = 1 and leaving_date <= '".$date."' and return_confirm is null";
	$stmt_sql = $connection->query($stmt);
	$goingnum = mysqli_fetch_row($stmt_sql);

	//var_dump("gone/going students ".(int)$goingnum[0]);

	//$stmt = "select count(*) from outpass_details where return_confirm = '".$date."' and leaving_date != '".$date."'";
	//$stmt_sql = $connection->query($stmt);
	//$comingnum = mysqli_fetch_row($stmt_sql);

	//var_dump((int)$comingnum[0]);

	//var_dump(date('Y-m-d'));

	//$val =   3000-((int)$goingnum[0])+((int)$comingnum[0]-(int)$neutral[0]);
	$val =   3000-(int)$goingnum[0]-(int)$neutral[0]+(int)$coming[0];

	if($val>3000)
		return 3000;
	else
		return $val;
}