<?php
	$host = "localhost"; // Host name 
	$db_username = "redstorge"; // Mysql username 
	$db_password = "redstorge"; // Mysql password 
	$db_name = "redstorge"; // Database name 

	$mysqli_conection = mysqli_connect($host, $db_username, $db_password, $db_name)or die("cannot connect"); 
?>