<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(isset($_POST['f1'])){
		$name=$_POST['name'];
		$mobile=$_POST['mobile'];
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$sql="UPDATE students SET password='$password' WHERE name='$name' AND mobile='$mobile' AND email='$email'";
		$result=mysqli_query($conn,$sql);
		if($result){
			echo "<script>alert('Your Password succesfully changed');</script>";
		}else{
			echo "<script>alert('Email id or Mobile no is invalid');</script>"; 
		}
	}
	mysqli_close($conn);
?>
<html>
	<link rel="icon" type="image/ico" href="images/2.png" />
	<body style="background-color:black;">
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
		</style>
		<script type="text/javascript">
			function valid(){
				if(document.f1.sid.value!='' &&document.f1.name.value!='' &&document.f1.mobile.value!='' &&document.f1.email.value!='' &&document.f1.password.value!='' &&document.f1.confirmpassword.value!=''){
					if(document.f1.password.value!= document.f1.confirmpassword.value){
						alert("Password and Confirm Password Field do not match  !!");
						document.f1.confirmpassword.focus();
						return false;
					}
					return true;
				}else{
					alert("Input Field shouln't be empty!!");
					return false;
				}	
			}
		</script>
		<?php include('menu.php'); ?>
			<div class="text-block">
				<form method="POST" name="f1" onSubmit="return valid();">
					<center id="center"><h2>Changing Password Form</h2></center>
					Reg Name:<input type="text" name="name" autocomplete="off"><br>
					Reg Mobile No.:<input type="text" name="mobile" autocomplete="off"><br>
					Reg Email:<input type="email" name="email" autocomplete="off"><br>
					New Password:<input type="password" name="password" autocomplete="off"><br>
					Confirm Password:<input type="password" name="confirmpassword" autocomplete="off"><br>
					<button type="submit" name="f1" id="f1">Change Password</button>
				</form>
			</div>
		</div>
	</body>
</html>