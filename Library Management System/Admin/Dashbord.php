<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['alogin'])==0){   
	header('location:http://localhost/Summer%20Project/Home.php');
	}
?>
<html>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
	<style>
		     #body ul {
				float:right;
			}
			#body a {
				text-decoration:none; //defult is underline border
				font-weight:bolder;
				font-size:x-large;
				color:white;
			}
			
			#body {
				width:100%;
			}
			#header-1-1 {
				height:14%;
				float:left;
				width:10%;
			}
			#header-1-2 {
				height:14%;
				float:right;
				width:90%;
			}
			h1,h2,h4,h3,p {
				color:red;
			}
			th{
				color:Peru  ;
			}
			input,select{
				font-size:14pt;
				height:30px;
			}
			label{
				font-size:x-large;
			}
			.text-block {
				position: absolute;
				top: 30%;
				left:12%;
				background-color: black;
				color: white;
				padding-left: 80px;
				padding-right: 80px;
				font-size:x-large;
			}
			#table{
				color:blue;
				width:100%;
			}
			#center{
				background-color:orange;
			}
			.button {
				display: inline-block;
				padding: 5px 5px;
				font-size: 20px;
				cursor: pointer;
				text-align: center;
				text-decoration: none;
				outline: none;
				color: #fff;
				background-color: #4CAF50;
				border: none;
				border-radius: 10px;
				box-shadow: 0 9px #999;
			}
			.button:hover {
				background-color: #3e8e41
			}
			.button:active {
				background-color: #3e8e41;
				box-shadow: 0 5px #666;
				transform: translateY(4px);
			}
			#table-scroll {
				height:200px;
				overflow:auto;  
			}.dropbtn {
				background-color: black;
				color: white;
				padding: 15px;
				font-size: 16px;
				border: none;
				border-radius: 30px;
				font-size:x-large;
				color:white;
				font-family: "Times New Roman", Times, serif;
			}.dropdown {
				position: relative;
				display: inline-block;
			}.dropdown-content {
				display: none;
				position: absolute;
				border-radius: 30px;
				background-color: green;
				min-width: 160px;
				box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
				z-index: 1;  
			}.dropdown-content a {
				color: black;
				padding: 12px 16px;
				text-decoration: none;
				display: block;
				border-radius: 30px;
			}.dropdown-content a:hover {background-color: red;
			}.dropdown:hover .dropdown-content {display: block;
			}.dropdown:hover .dropbtn {background-color: red;}
		</style>
		<?php include('menu.php'); ?>
			<div class="text-block">
				<center id="center"><h2>ADMIN DASHBOARD</h2></center>
				<table cellpadding="5" >
				<tr>
				<td><img src="images/5.png" height="120" width="200" ><br><p style="font-size:20px"><?php 
					$sql="SELECT id from books";
					$result=mysqli_query($conn,$sql);
					if($result){
					$books=mysqli_num_rows($result);
					echo $books;
					}
				?> Books Listed</p></td>
				<td><img src="images/6.jpg" height="120" width="200" ><br><p style="font-size:20px"><?php 
					$sql="SELECT id from issuedbooks";
					$result=mysqli_query($conn,$sql);
					if($result){
					$issuedbooks=mysqli_num_rows($result);
					echo $issuedbooks;
					}
				?> Times Book Issued</td>
				<td><img src="images/8.png" height="120" width="200" ><br><p style="font-size:20px"><?php 
					$sql="SELECT id from issuedbooks where ReturnStatus IS NULL";
					$result=mysqli_query($conn,$sql);
					if($result){
					$booksnotreturn=mysqli_num_rows($result);
					echo $booksnotreturn;
					}
				?> Books Not Returned Yet</td>
				</tr>
				<tr>
				<td><img src="images/7.png" height="120" width="200" ><br><p style="font-size:20px"><?php 
					$rsts=1;
					$sql="SELECT id from issuedbooks where ReturnStatus='$rsts'";
					$result=mysqli_query($conn,$sql);
					if($result){
					$booksreturn=mysqli_num_rows($result);
					echo $booksreturn;
					}
				?> Books Returned</td>
				<td><img src="images/9.jpg" height="120" width="200" ><br><p style="font-size:20px"><?php 
					$sql="SELECT id from students";
					$result=mysqli_query($conn,$sql);
					if($result){
					$users=mysqli_num_rows($result);
					echo $users;
					}
				?> Registered Users</td>
				</tr>
				</table>
			</div>
		</div>
	</body>
</html>