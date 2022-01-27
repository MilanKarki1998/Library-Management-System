<?php
	session_start();
	error_reporting(0);
	include('connect.php');
	if(strlen($_SESSION['login'])==0){   
		header("Location:http://localhost/Summer%20Project/Home.php");
	}else{ 
		if(isset($_POST['Submit'])){
			$oldpass=md5($_POST['Cpassword']); 
			$newpassword=md5($_POST['Npassword']);
			$sid=$_SESSION['login'];
			$sql="SELECT * FROM students where StudentId='$sid'";
			$result=mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)>0){
				while($rows=mysqli_fetch_assoc($result)){
					if ($oldpass==$rows['password']) {
						mysqli_query($conn, "UPDATE students SET password='$newpassword' WHERE StudentId='$sid'");
						echo '<script>alert("Password Change")</script>';
					}else{
						echo '<script>alert("Current Password is not correct")</script>';
					}
				}
			}
		}mysqli_close($conn);
	}
?>
<html>
<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript">
			function check()
			{
				var pword=document.f1.Cpassword.value;
				var nword=document.f1.Npassword.value;
				var rword=document.f1.Rpassword.value;
				if (nword=="" || rword=="" || pword==""){
					alert("All fields are required!");
					return false;
				}else if(nword!=rword){
					alert("New password and retype new Password doesn't match");
					return false;
				}else{
					return true;
				}
			}
			$(document).ready(function(){
				$("#Npassword").keyup(function(){
					check_pass();
				});
			});
			function check_pass(){
			var val=document.getElementById("Npassword").value;
			var no=0;
			if(val!=""){
				// If the password length is less than or equal to 6
				if(val.length<=6)no=1;
				// If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
				if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;
				  // If the password length is greater than 6 and contain alphabet,number,special character respectively
				  if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;
				  // If the password length is greater than 6 and must contain alphabets,numbers and special characters
				  if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;
				  if(no==1){
					document.getElementById("pass_type").innerHTML="Very Weak";
				  }
				  if(no==2){
					document.getElementById("pass_type").innerHTML="Weak";
				  }
				  if(no==3){
					document.getElementById("pass_type").innerHTML="Good";
				  }
				  if(no==4){
					document.getElementById("pass_type").innerHTML="Strong";
				  }
			 }else{
				document.getElementById("pass_type").innerHTML="";
			 }
		}
		</script>
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
				<form name="f1" onSubmit="return check()" method="POST">
				<center style="background-color:orange;"><h2>Password Changing Form</h2></center></br>
				<table id="table">
				<tr><td><label>Current Password:</label></td><td><input type="text" id="Cpassword" name="Cpassword"></td></tr>
				<tr><td><label>New Password:</label></td><td><input type="password" id="Npassword" name="Npassword"><span id="pass_type"></span></td></tr>
				<tr><td><label>Retype Password:</label></td><td><input type="password" id="Rpassword" name="Rpassword"></td></tr>
				</table><br>
				<button class="button" name="Submit" id="Submit">Change Password</button>
				</form>
			</div>
		</div>
	</body>
</html>