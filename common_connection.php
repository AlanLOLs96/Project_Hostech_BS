<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "hostech";

$connection = new mysqli($server,$username,$password,$database);

if ($connection->connect_error)
	echo "Connection Failed";

