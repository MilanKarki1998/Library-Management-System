<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if($_SESSION['alogin']!=''){
	$_SESSION['alogin']='';
	}
	if(isset($_POST['Submit'])){
		$name=$_POST['name']; 
		$pword=md5($_POST['password']);
		$sql="SELECT name,password FROM admin where name='$name' AND password='$pword'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>0){
			while($rows=mysqli_fetch_assoc($result)){
				$_SESSION['alogin']=$name;
				echo "<script type='text/javascript'> document.location ='Admin/Dashbord.php'; </script>";
			}
		}else
        echo '<script>alert("Name or Password not correct")</script>';
	}
	mysqli_close($conn);
?>
<html>
<head>
	<title>Admin Login</title>
</head>
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
			input{
				font-size:14pt;
				height:30px;
				
			}
			.checkbox{
				height:20px;
				width:20px;
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
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
		<?php include('menu.php'); ?>
			<div class="text-block">
				<form name="f1" method="POST" onSubmit="return check()">
					<center id="center"><h2>Admin Login Form</h2></center></br>
					Admin name:<input type="text" id="name" name="name" autocomplete="off" required><br>
					Password:<input type="password" id="password" name="password" autocomplete="off" required><br><br>
					<input type="checkbox" class="checkbox" onclick="myFunction()">Show Password<br><br>
					<button class="button" type="submit" id="Submit" name="Submit">Login</button>
				</form>
			</div>
		</div>
	</body>
</html>