<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:http://localhost/Summer%20Project/Home.php');
	}
	else{ 
		$id=$_GET['id'];
		$sql="DELETE FROM issuedbooks WHERE id=$id";
		$result=mysqli_query($conn,$sql);
		if($result){
			header("Location:IssBooks.php");
		}else{
			echo "Error Deleting";
		}
		mysqli_close($conn);
	}
?>