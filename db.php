<?php
	//We start sessions
	session_start();

	// Gerekli Bilgiler
	$mysql_hostname = 'localhost';
	$mysql_user = 'gbyfAdmin';
	$mysql_password = 'password';
	$mysql_database = 'gbyfDatabase';

	//We log to the DataBase
	$conn = new mysqli($mysql_hostname, $mysql_user, $mysql_password);
	
	if ($conn->connect_error) 
	{
		die("Connection failed: " . $conn->connect_error);
	} 
	
	
	mysqli_select_db($conn, $mysql_database) or die("Opps some thing went wrong");
	
	$url_home = 'anasayfa.php';
	$url_admin = 'adminAnasayfa.php';
	
?>
