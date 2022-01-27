<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
		header('location:http://localhost/Summer%20Project/Home.php');
	}else{ 
		$id=$_GET["id"];
		$name=$_POST["Name"];
		$cat=$_POST["Cat"];
		$aut=$_POST["Aut"];
		$isbn=$_POST["isbn"];
		$price=$_POST["pri"];
		$copies=$_POST['copies'];
		$query = "select * from books where id=$id";
		$result = mysqli_query($conn,$query);$cnt=1;
		if(mysqli_num_rows($result)>0){
			while($row = mysqli_fetch_assoc($result)){
				$x=$row['TCopies'];
				$y=$row['Copies'];
				$z=$x-$y;
				$tcopies=$copies+$z;
				$sql="UPDATE books SET Book_Name='$name',Category='$cat',Author='$aut',ISBN='$isbn',Price='$price',TCopies='$tcopies',Copies='$copies' where id=$id";
				$result=mysqli_query($conn,$sql);
				if($result){
					header("Location:Books.php");
				}else{
					echo "has problem updating value.".mysqli_error($conn);
				}
			}
		}mysqli_close($conn);
	}
?>