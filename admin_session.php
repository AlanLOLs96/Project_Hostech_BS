<?php
   include_once('common_connection.php');
   session_start();

   $user_check = $_SESSION['login_user'];

   $sql = "select * from admin_details where username = '$user_check' ";
   $result = $connection->query($sql);

	$admin_details = $result->fetch_array(MYSQLI_ASSOC);
   
   $login_session = $admin_details['username'];

   if(!isset($_SESSION['login_user'])){
      header("location:index.php");
   }
?>