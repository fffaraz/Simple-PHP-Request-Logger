<?php
include ('logconfig.php');

// Create connection
$con = mysqli_connect($log_host, $log_username, $log_passwd, $log_dbname);

// Check connection
if (mysqli_connect_errno($con))
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

