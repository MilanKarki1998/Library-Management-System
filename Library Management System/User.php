<?php
session_start();
error_reporting(0);
include('connect.php');
if($_SESSION['login']!=''){
	$_SESSION['login']='';
}
if(isset($_POST['login'])){
	$sid=$_POST['sid'];// Get username
	$password=md5($_POST['password']);// get password 
	//query for match  the user inputs
	$sql ="SELECT * FROM students WHERE StudentId='$sid' AND password='$password'";
	$result=mysqli_query($conn,$sql);
	$num=mysqli_fetch_array($result);
	// if user inputs match if condition will runn
	if($num>0){
		$_SESSION['login']=strtoupper($sid); // hold the user name in session
		$name=$num['name']; // hold the user id in session
		$uip=$_SERVER['REMOTE_ADDR']; //get the user ip
		if($num['Status']==1){
			mysqli_query($conn,"insert into userlog(StdID,StdName,StdIP) values('".$_SESSION['login']."','$name','$uip')");
			// code redirect the page after login
			$extra="User/Dashbord.php";
			$host=$_SERVER['HTTP_HOST'];
			$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
			exit();
		}else {
			echo "<script>alert('Your Account Has been blocked .Please contact admin');</script>";
		}
	}
	// If the userinput no matched with database else condition will run
	else
		echo '<script>alert("Student-ID or Password not correct")</script>';
	}
	mysqli_close($conn);
?>

<html>
<head>
	<title>User Login</title>
</head>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
	<script language="javascript">
			function check()
			{
				var email=document.f1.sid.value;
				var pword=document.f1.password.value;
				if (email=="" || pword==""){
					alert("All fields are required!");
					return false;
				}else{
					return true;
				}
			}
		</script>
		<style>
					#body ul {
				float:right;
			}
			#body li {
				display:inline;
				border-radius: 30px;
				background: Black;
				padding: 15px; 
			}
			#body a {
				text-decoration:none; //defult is underline border
				font-weight:bolder;
				font-size:x-large;
				color:white;
			}
			#body li:hover {
				background:red;
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
			input,select{
				font-size:14pt;
				height:30px;
			}
			h1,h4,h3,p {
				color:red;
			}
			th{
				color:Peru  ;
			}
			.text-block {
				position: absolute;
				top: 33%;
				left:25%;
				background-color: black;
				color: white;
				padding-left: 100px;
				padding-right: 100px;
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
			}
			.checkbox{
				height:20px;
				width:20px;
			}
		</style>
		<script language="javascript">
		function myFunction() {
			var x = document.getElementById("password");
				if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
	</script>
		<?php include('menu.php'); ?>
			<div class="text-block">
				<form name="f1" method="POST" >
					<center id="center"><h2>Login Form</h2></center><br>
					Student ID:<input type="text" name="sid" autocomplete="off" required><br>
					Password:<input type="password" name="password" id="password" autocomplete="off" required><br>
					<a href="fpassword.php" id="a" style="font-size:smaller; color:blue;">Forgot password?</a><br><br>
					<input type="checkbox" class="checkbox" onclick="myFunction()">Show Password<br><br>
					<button class="button" type="submit" name="login">Login</button>&nbsp <a href="Signup.php" id="a" style="font-size:large; color:blue;">Not Register Yet!</a>
				</form>
			</div>
		</div>
	</body>
</html>