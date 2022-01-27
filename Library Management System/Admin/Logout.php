<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:Home.php');
	}
	else{
		session_destroy();  
		header("Location: http://localhost/Summer%20Project/Home.php");  
	}
?> 