<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['login'])==0){ 
		header("Location:http://localhost/Summer%20Project/Home.php");
	}else{
		session_destroy();  
		header("Location: http://localhost/Summer%20Project/Home.php");  
	}
?> 